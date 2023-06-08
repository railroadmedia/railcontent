<?php

namespace App\Modules\Reporting\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class YouTrackCompletedItemsReport
{

    private $agiles = [
        "UX" => "121-5",
        "FEW" => "121-22",
        "MA" => "121-7",
        "BE" => "121-8",
        //"QA" => "121-9",
    ];
    private $fields =
        [
            'BE' => [
                'sprint' => '{Board S - BE Dev Team Sprints}',
                'state' => 'BE Dev State'
            ],
            'FEW' => [
                'sprint' => '{Board S - FEW Dev Team Sprints}',
                'state' => 'FEW Dev State'
            ],
            'MA' => [
                'sprint' => '{Board S - MA Dev Team Sprints}',
                'state' => 'MA Dev State'
            ],
            'UX' => [
                'sprint' => '{Board S - UX Design Team Sprints}',
                'state' => 'UX Design State'
            ],
            'QA' => [
                'sprint' => '{Board S - QA Team Sprints}',
                'state' => 'QA State'
            ]
        ];

    private string $report = "";

    private function info(string $text)
    {
        if ($this->report) {
            $text = '<br>' . $text;
        }
        $this->report .= $text;
    }

    public function generate($startDate, $endDate)
    {
        $startTicks = strtotime($startDate) * 1000;
        $endTicks = strtotime($endDate) * 1000;

        $this->info("Report generated for $startDate to $endDate");

        foreach ($this->agiles as $name => $agileId) {
            $json = $this->getJson("agiles/$agileId/sprints", ['fields' => 'id,name,start,finish', '$top' => 1000]);
            $data = collect($json);

            $sprints = $data->where('finish', '>', $startTicks)->where('finish', '<', $endTicks);

            $this->info("# $name");

            foreach ($sprints as $sprint) {
                $this->sprintReport($agileId, $sprint, $name);
            }
        }

        return $this->report;
    }

    public function getJson(string $url, array $queryData): mixed
    {
        $queryString = Arr::query($queryData);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer perm:cm9id2lsbGVtcw==.NTUtMg==.wm5dVsIcxPR4xpL0JRkqItuHThrwml',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->get("https://musoraproduct.myjetbrains.com/youtrack/api/$url?$queryString");
        $json = $response->json();
        return $json;
    }

    public function sprintReport($agileId, $sprint, $teamName): void
    {
        $sprintName = $sprint['name'];
        $sprintid = $sprint['id'];
        $start = date('M j', $sprint['start'] / 1000);
        $end = date('M j', $sprint['finish'] / 1000);
        $this->info(
            "## [$sprintName](https://musoraproduct.myjetbrains.com/youtrack/agiles/$agileId/$sprintid) - $start to $end"
        );
        $sprintField = $this->fields[$teamName]['sprint'];
        $stateField = $this->fields[$teamName]['state'];
        $queryData = [
            'fields' => 'id,idReadable,summary,project(name),sprint',
            'query' => "$sprintField: {{$sprintName}} $stateField: Complete"
        ];

        $json = $this->getJson("issues", $queryData);

        $groups = collect($json)->groupBy(function (array $item) {
            return $item['project']['name'];
        })->sortBy(function ($items, $key) {
            return $key;
        });
        foreach ($groups as $key => $group) {
            $this->info("### $key");
            $group->sortBy(function ($item) {
                return $item['id'];
            })->each(function ($item) {
                $id = $item['idReadable'];
                $summary = $item['summary'];
                $this->info("[$id - $summary](https://musoraproduct.myjetbrains.com/youtrack/issue/$id)");
            });
            $this->info("");
        }
        $this->info("");
        $this->info("");
    }


}
