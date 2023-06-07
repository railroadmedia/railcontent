<?php

namespace App\Modules\Reporting\Controllers;

use App\Modules\Reporting\Services\YouTrackCompletedItemsReport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReportController extends Controller
{

    public function generate(Request $request, string $id)
    {
        $startDate = $request->get('start');
        $endDate = $request->get('end');

        $report = $this->getReport($id, $startDate, $endDate);

        if ($report) {
            $reportWrapper = "$report";
            return $reportWrapper;
        }

        abort(404);
    }

    private function getReport(string $id, $startDate, $endDate)
    {
        switch ($id) {
            case "completed-items":
                return app()->make(YouTrackCompletedItemsReport::class)->generate($startDate, $endDate);
        }
        return null;
    }
}
