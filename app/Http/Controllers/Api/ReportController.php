<?php
namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Report\StoreReportRequest;
use App\Http\Requests\Report\UpdateReportRequest;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function store(StoreReportRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // ✅ رفع الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'reports');
        }

        $report = $this->reportService->createReport($data);

        return Helpers::jsonResponse(true, $report, 'Report created successfully', 201);
    }

    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();

        // ✅ تعديل الصورة بإضافة الرابط الكامل
        foreach ($reports as $report) {
            $report->image = $report->image ? asset('reports/' . $report->image) : null;
        }

        return Helpers::jsonResponse(true, $reports, 'Reports retrieved successfully');
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $data = $request->validated();

        // ✅ تحديث الصورة إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($report->image) {
                $this->deleteImage($report->image, 'reports');
            }
            $data['image'] = $this->uploadImage($request->file('image'), 'reports');
        }

        $updatedReport = $this->reportService->updateReport($report, $data);

        return Helpers::jsonResponse(true, $updatedReport, 'Report updated successfully');
    }

    public function destroy(Report $report)
    {
        // ✅ حذف الصورة عند حذف التقرير
        if ($report->image) {
            $this->deleteImage($report->image, 'reports');
        }

        $this->reportService->deleteReport($report);

        return Helpers::jsonResponse(true, null, 'Report deleted successfully');
    }
}
