<?php

namespace App\Console\Commands;

use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PapertrailErrorCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'papertrail:error-counts
                            {date : The date to get the error messages for. e.g. 2024-01-01}
                            {groupId=36174881 : The Group ID used to identify where to pull from in Papertrail. e.g. 36723761 for beta-testing}
                            {query=production.ERROR : The query to search for (and exclude from results)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the different error messages and their counts, from Papertrail';

    protected const string URL = 'https://papertrailapp.com/api/v1/events/search.json';
    protected const int MESSAGE_SIZE_LIMIT = 150;
    protected Collection $errors;
    protected int $groupId;
    protected string $query;
    protected int $limit;
    protected int $minTime;
    protected int $maxTime;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->errors = collect();

        $date = CarbonImmutable::parse($this->argument('date'));
        $this->minTime = $date->startOfDay()->timestamp;
        $this->maxTime = $date->endOfDay()->timestamp;
        $this->groupId = $this->argument('groupId');
        $this->query = $this->argument('query');
        $this->limit = 1000;

        try {
            $hasMoreResults = true;
            $response = $this->makeRequest();

            // safety fallback
            $loopMax = 100;
            while ($hasMoreResults && $loopMax > 0) {
                $responseEvents = collect($response['events'])
                    ->map(function (array $event) {
                        // get the actual message (after the type of message, and before the context)
                        $message = Str::betweenFirst($event['message'], sprintf('%s: ', $this->query), ' {');
                        // we can have a lot of the same sort of message, but with a unique ID etc. so remove anything like that from the end
                        $message = rtrim($message);
                        if (preg_match('/\s(\d+)$/', $message, $matches)) {
                            $message = substr($message, 0, -strlen($matches[0]));
                        }
                        return $message;
                    })
                    ->countBy();

                // record each message: increasing the count, or adding the new entry
                $responseEvents->each(function ($count, $message) {
                    if ($this->errors->has($message)) {
                        $this->errors[$message] += $count;
                    } else {
                        $this->errors[$message] = $count;
                    }
                });

                // if there are more records to get, grab the min_id and pass it through for the next run
                $hasMoreResults = array_key_exists('reached_record_limit', $response) && $response['reached_record_limit'] == true;
                if ($hasMoreResults) {
                    $response = $this->makeRequest($response['min_id']);
                }
                $loopMax--;
            }

        } catch (ConnectionException $e) {
            $this->error('Connection failed: ' . $e->getMessage());
            return self::FAILURE;
        } catch (RequestException $e) {
            $this->error('Unsuccessful request: ' . $e->getMessage());
            return self::FAILURE;
        }

        // sort the results and print out the table
        $this->errors = $this->errors->sortByDesc(function ($count) {
            return $count;
        })->map(function ($count, $message) {
            return [
                'count' => $count,
                'message' => Str::limit($message, self::MESSAGE_SIZE_LIMIT, ' [...]'),
            ];
        });

        $this->table(
            ['Count', 'Error'],
            $this->errors->toArray()
        );

        return self::SUCCESS;
    }

    /**
     * Perform the query in Papertrail
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    protected function makeRequest(?int $maxId = null)
    {
        $params = [
            'group_id' => $this->groupId,
            'min_time' => $this->minTime,
            'max_time' => $this->maxTime,
            'limit' => $this->limit,
            'q' => $this->query,
        ];

        // for pagination, apply the max_id
        if ($maxId !== null) {
            $params['max_id'] = $maxId;
        }

        $response = Http::withHeaders(['X-Papertrail-Token' => env('PAPERTRAIL_API_TOKEN')])
            ->acceptJson()
            ->withQueryParameters($params)
            ->get(self::URL);

        // throw an exception if the response wasn't successful
        $response->throwUnlessStatus(200);
        return $response->json();
    }
}
