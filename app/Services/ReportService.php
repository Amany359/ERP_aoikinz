<?php
namespace App\Services;

use App\Models\Report;

class ReportService
{
    public function createReport($data)
    {
        return Report::create($data);
    }

    public function updateReport(Report $report, $data)
    {
        $report->update($data);
        return $report;
    }

    public function deleteReport(Report $report)
    {
        return $report->delete();
    }
}
