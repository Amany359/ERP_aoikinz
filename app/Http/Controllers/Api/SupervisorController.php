<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supervisor\StoreSupervisorRequest;
use App\Http\Requests\Supervisor\UpdateSupervisorRequest;
use App\Services\SupervisorService;
use App\Helpers\Helpers;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    protected $supervisorService;

    public function __construct(SupervisorService $supervisorService)
    {
        $this->supervisorService = $supervisorService;
    }

    /**
     * جلب جميع المشرفين
     */
    public function index()
    {
        $supervisors = $this->supervisorService->getAll();
        return Helpers::jsonResponse(true, 'تم استرجاع جميع المشرفين بنجاح', $supervisors);
    }

    /**
     * عرض بيانات مشرف معين
     */
    public function show($id)
    {
        $supervisor = $this->supervisorService->getById($id);
        if (!$supervisor) {
            return Helpers::jsonResponse(false, 'المشرف غير موجود', null, 404);
        }
        return Helpers::jsonResponse(true, 'تم استرجاع بيانات المشرف بنجاح', $supervisor);
    }

    /**
     * إنشاء مشرف جديد
     */
    public function store(StoreSupervisorRequest $request)
    {
        $data = $request->validated();
        $supervisor = $this->supervisorService->store($data);
        return Helpers::jsonResponse(true, 'تم إنشاء المشرف بنجاح', $supervisor, 201);
    }

    /**
     * تعديل بيانات المشرف
     */
    public function update(UpdateSupervisorRequest $request, $id)
    {
        $supervisor = $this->supervisorService->getById($id);
        if (!$supervisor) {
            return Helpers::jsonResponse(false, 'المشرف غير موجود', null, 404);
        }
        $data = $request->validated();
        $updatedSupervisor = $this->supervisorService->update($supervisor, $data);
        return Helpers::jsonResponse(true, 'تم تحديث بيانات المشرف بنجاح', $updatedSupervisor);
    }

    /**
     * حذف مشرف
     */
    public function destroy($id)
    {
        $supervisor = $this->supervisorService->getById($id);
        if (!$supervisor) {
            return Helpers::jsonResponse(false, 'المشرف غير موجود', null, 404);
        }
        $this->supervisorService->delete($supervisor);
        return Helpers::jsonResponse(true, 'تم حذف المشرف بنجاح');
    }

    /**
     * جلب رسائل المشرف
     */
    public function messages($id)
    {
        $supervisor = $this->supervisorService->getById($id);
        if (!$supervisor) {
            return Helpers::jsonResponse(false, 'المشرف غير موجود', null, 404);
        }
        $messages = $supervisor->messages; // العلاقة في موديل Supervisor
        return Helpers::jsonResponse(true, 'تم استرجاع الرسائل بنجاح', $messages);
    }

    /**
     * جلب معاملات المشرف
     */
    public function transactions($id)
    {
        $supervisor = $this->supervisorService->getById($id);
        if (!$supervisor) {
            return Helpers::jsonResponse(false, 'المشرف غير موجود', null, 404);
        }
        $transactions = $supervisor->transactions; // العلاقة في موديل Supervisor
        return Helpers::jsonResponse(true, 'تم استرجاع المعاملات بنجاح', $transactions);
    }

    /**
     * جلب تقارير المشرف
     */
    public function reports($id)
    {
        $supervisor = $this->supervisorService->getById($id);
        if (!$supervisor) {
            return Helpers::jsonResponse(false, 'المشرف غير موجود', null, 404);
        }
        $reports = $supervisor->reports; // العلاقة في موديل Supervisor
        return Helpers::jsonResponse(true, 'تم استرجاع التقارير بنجاح', $reports);
    }
}
