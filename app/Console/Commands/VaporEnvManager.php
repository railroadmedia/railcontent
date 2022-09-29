<?php

namespace App\Console\Commands;

use Aws\Credentials\Credentials;
use Aws\Ssm\SsmClient;
use Dotenv\Dotenv;
use Illuminate\Console\Command;

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $environmentName = $this->argument('environment');
        $pushOrPull = $this->argument('pushOrPull');

        $credentials = new Credentials(env('S3_KEY'), env('S3_SECRET'));

        //Create an S3Client
        $ssmClient = new SsmClient([
            'version' => 'latest',
            'region' => 'us-east-2',
            'credentials' => $credentials
        ]);

        $allParameters = $ssmClient->describeParameters();
        $parametersForEnvironment = [];

        foreach ($allParameters->toArray()['Parameters'] ?? [] as $parameterData) {
            $parameterNamePathParts = explode('/', trim($parameterData['Name'], '/'));
            $parameterEnvironmentPathName = $parameterNamePathParts[0];
            $parameterSecretName = $parameterNamePathParts[1];


            if ($parameterEnvironmentPathName == ('musora-web-platform-' . $environmentName) &&
                str_starts_with($parameterSecretName, 'DOT_ENV_')) {
                $parametersForEnvironment[] = $parameterData;
            }
        }

        if (empty($parametersForEnvironment)) {
            $this->error('Could not find parameter for environment.');
            return false;
        }

        $allKeyValueEnvironmentVariables = [];

        foreach ($parametersForEnvironment as $parameterData) {
            $parameterValueData = $ssmClient->getParameter([
                'Name' => $parameterData['Name'],
                'WithDecryption' => true,
            ])->toArray();

            $parameterValueString = $parameterValueData['Parameter']['Value'] ?? '';

            $parameterKeyValues = Dotenv::parse($parameterValueString);

            $allKeyValueEnvironmentVariables = array_merge($allKeyValueEnvironmentVariables, $parameterKeyValues);
        }

        dd($allKeyValueEnvironmentVariables);

//        $lambdaClient = new LambdaClient([
//            'version' => 'latest',
//            'region' => 'us-east-2',
//            'credentials' => $credentials
//        ]);
//
//        $result = $lambdaClient->listFunctions();
//        $result = $lambdaClient->getFunctionConfiguration([
//            'FunctionName' => 'vapor-musora-web-platform-app-staging-two-cli',
//        ]);


        return 0;
    }
}
