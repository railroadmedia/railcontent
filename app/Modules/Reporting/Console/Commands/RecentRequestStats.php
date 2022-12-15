<?php

namespace App\Modules\Reporting\Console\Commands;

use App\Console\Commands\Infrastructure\Command;

class RecentRequestStats extends Command
{
    protected $signature = 'report:recentRequests';
    protected $description = 'Provides recent request data on hits and request duration';


    public function handle()
    {
        $this->info("$this->name");

        $nRequests = 1000000;
        $nResults = 20;

        $this->info("Results based on last $nRequests requests");

        $this->info("Top hit counts with average duration");
        $sql = "SELECT route_name, count(id) hits, avg(response_duration_ms) ms
                        FROM (SELECT * FROM railtracker4_requests order by id desc limit $nRequests) requests
                        group by route_name
                        order by hits desc
                        limit $nResults";
        $this->infoSQL($sql);

        $this->info("Most expensive requests");
        $sql = "SELECT id, user_id, route_name,response_status_code as code, response_duration_ms as ms, ip_country_name, ip_city, concat(url_protocol,'://',url_domain,url_path) as url, requested_on
                        FROM (SELECT * FROM railtracker4_requests order by id desc limit $nRequests) requests
                        order by response_duration_ms desc
                        limit $nResults";
        $this->infoSQL($sql);

        $this->info("Recent Errors");
        $sql = "SELECT id, user_id, route_name, response_status_code as code,  response_duration_ms as ms, ip_country_name, ip_city, concat(url_protocol,'://',url_domain,url_path) as url, requested_on
                        FROM (SELECT * FROM railtracker4_requests order by id desc limit $nRequests) requests
                        where response_status_code >= 500
                        order by id desc
                        limit $nResults";
        $this->infoSQL($sql);
    }
}
