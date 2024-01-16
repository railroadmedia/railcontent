<?php

namespace App\Console\Commands;

use Aws\Credentials\Credentials;
use Aws\Ssm\SsmClient;
use Dotenv\Dotenv;
use Google\Exception;
use Illuminate\Console\Command;
use Laravel\VaporCli\ConsoleVaporClient;
use Laravel\VaporCli\Helpers;
use Laravel\VaporCli\Manifest;
use Laravel\VaporCli\Path;
use NumberFormatter;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VaporEnvManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'VaporEnvManager {environment} {pushOrPull}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For managing laravel vapor env vars.';

    /**
     * Execute the command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Helpers::app()->instance('input', $this->input = $input);
        Helpers::app()->instance('output', $this->output = $output);

        return Helpers::app()->call([$this, 'handle']) ?: 0;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $environmentName = $this->argument('environment');
        $pushOrPull = $this->argument('pushOrPull');

        if ($pushOrPull === 'pull') {
            $this->pull($environmentName);
        } elseif ($pushOrPull === 'push') {
            $this->push($environmentName);
        }


        return 0;
    }

    private function pull($environmentName)
    {
        $allEnvironmentVariablesFileString = '';

        // get all secret based variables that are in AWS parameter store
        $credentials = new Credentials(env('S3_KEY'), env('S3_SECRET'));

        $ssmClient = new SsmClient([
            'version' => 'latest',
            'region' => 'us-east-2',
            'credentials' => $credentials
        ]);

        // MaxResults
        $allParameters = [];
        $maxResults = 3;
        $nextToken = null;

        do {
            $parametersResponse = $ssmClient->describeParameters([
                'NextToken' => $nextToken,
                "MaxResults" => $maxResults
            ]);

            $nextToken = $parametersResponse['NextToken'] ?? null;

            $allParameters = array_merge($allParameters, $parametersResponse->toArray()['Parameters']);
        } while (count($parametersResponse['Parameters']) == $maxResults && !empty($parametersResponse['NextToken']));

        $parametersForEnvironment = [];

        foreach ($allParameters ?? [] as $parameterData) {
            $parameterNamePathParts = explode('/', trim($parameterData['Name'], '/'));
            $parameterEnvironmentPathName = $parameterNamePathParts[0];
            $parameterSecretName = $parameterNamePathParts[1];

            if ($parameterEnvironmentPathName == ('musora-web-platform-' . $environmentName) &&
                str_starts_with($parameterSecretName, 'DOT_ENV_')) {
                $parametersForEnvironment[] = $parameterData;
            }
        }

        usort($parametersForEnvironment, function ($a, $b) {
            return strcmp($a["Name"], $b["Name"]);
        });

        foreach ($parametersForEnvironment as $parameterData) {
            $this->info('Getting env data from parameter: ' . $parameterData['Name']);
            $parameterValueData = $ssmClient->getParameter([
                'Name' => $parameterData['Name'],
                'WithDecryption' => true,
            ])->toArray();

            $parameterValueString = $parameterValueData['Parameter']['Value'] ?? '';

            $allEnvironmentVariablesFileString .= $parameterValueString . PHP_EOL;
        }

        // get all lambda environment variables which come from the vapor API
        /**
         * @var $vapor ConsoleVaporClient
         */
        $vapor = Helpers::app(ConsoleVaporClient::class);

        Helpers::app()->offsetSet('manifest', Path::defaultManifest());
        try {
            Helpers::ensure_api_token_is_available();
        } catch (\Exception $ex) {
            $this->error("Invalid vapour authentication. inner exception: $ex");
            Helpers::abort('Please authenticate with Vapor using the "login" command. Are your "laravelVaporEmail" and "laravelVaporPassword" set in the credentials/credentials?');
        }


        $vaporEnvironmentVariablesString = $vapor->environmentVariables(
            Manifest::id(),
            $environmentName
        );

        $allEnvironmentVariablesFileString = $vaporEnvironmentVariablesString . PHP_EOL . $allEnvironmentVariablesFileString;
        $allEnvironmentVariablesFileString = preg_replace("/[\r\n]+/", "\n", $allEnvironmentVariablesFileString);

        // put them all in to a single file
        $file = getcwd() . '/.env.full.' . $environmentName;

        file_put_contents($file, $allEnvironmentVariablesFileString);

        exec("chmod 0777 $file");

        $this->info('Saved environment variables to: ' . '.env.full.' . $environmentName);

        return true;
    }

    private function push($environmentName)
    {
        // split file in to the right sized chunks
        $file = getcwd() . '/.env.full.' . $environmentName;

        if (!file_exists($file)) {
            $this->error(
                'Environment file for ' . $environmentName .
                ' does not exist. Pull first. Checked for file: ' . $file
            );

            return 1;
        }

        $allEnvironmentVariablesFileString = file_get_contents($file);
        $remainingString = $allEnvironmentVariablesFileString;
        $stringChunksToSave = [];

        while (strlen($remainingString) > 0) {
            $chunk = substr($remainingString, 0, 1536);
            $lastNewlinePos = strrpos($chunk, "\n");

            if (!$lastNewlinePos) {
                break;
            }

            $finalChunk = substr($remainingString, 0, $lastNewlinePos + 1);
            $remainingString = substr($remainingString, $lastNewlinePos + 1);

            $stringChunksToSave[] = $finalChunk;
        }

        if (empty($stringChunksToSave)) {
            $this->error('No env chunks to save, error. Is your ' . $file . 'file formatted correctly?');

            if (!$this->confirm('Do you wish to continue and delete all secrets and env vars?')) {
                return 1;
            }
        }

        $this->info('Total chunks to save: ' . count($stringChunksToSave));

        // save first chunk via vapor lambda API
        /**
         * @var $vapor ConsoleVaporClient
         */
        $vapor = Helpers::app(ConsoleVaporClient::class);

        Helpers::app()->offsetSet('manifest', Path::defaultManifest());

        Helpers::ensure_api_token_is_available();

        $vapor->updateEnvironmentVariables(
            Manifest::id(),
            $environmentName,
            $stringChunksToSave[0] ?? "EMPTY_ENV=true"
        );

        $this->info('Successfully saved chunk 1 to lambda environment via vapor.');

        if (isset($stringChunksToSave[0])) {
            unset($stringChunksToSave[0]);
        }

        // save the rest of the chunk to AWS parameter store as vapor secrets
        $secretNamesToKeep = [];

        foreach ($stringChunksToSave as $stringChunkIndex => $stringChunkSecretValue) {
            $snakeCaseEnvironmentName = strtoupper(str_replace('-', '_', $environmentName));
            $stringIndexNumber = $stringChunkIndex;
            $secretName = 'DOT_ENV_' . $snakeCaseEnvironmentName . '_EXTENDED_' . $stringIndexNumber;

            $result = $vapor->storeSecret(
                Manifest::id(),
                $environmentName,
                $secretName,
                $stringChunkSecretValue
            );

            $secretNamesToKeep[] = $secretName;

            $this->info('Successfully saved chunk ' . ($stringIndexNumber + 1) . ' to secret: ' . $secretName);
        }

        // delete orphaned secrets
        $allSecretsSavedToVapor = $vapor->secrets(
            Manifest::id(),
            $this->argument('environment')
        );

        foreach ($allSecretsSavedToVapor as $secretsSavedToVapor) {
            if (!in_array($secretsSavedToVapor['name'], $secretNamesToKeep) &&
                str_starts_with($secretsSavedToVapor['name'], 'DOT_ENV_')) {
                $this->info('Found orphaned secret, deleting : ' . $secretsSavedToVapor['name']);

                $vapor->deleteSecret($secretsSavedToVapor['id']);

                $this->info('Successfully deleted secret: ' . $secretsSavedToVapor['name']);
            }
        }

        // delete env file
        unlink($file);
        $this->info('Deleted env file from local machine.');

        return true;
    }
}
