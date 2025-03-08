<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreUserRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Response;
use App\Helpers\Helpers;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * عرض جميع الموظفين.
     */
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return Helpers::jsonResponse(true, 'تم استرجاع جميع الموظفين بنجاح', $employees, Response::HTTP_OK);
    }

    /**
     * عرض موظف معين.
     */

/**
     * إنشاء موظف جديد.
     */
    public function store(StoreUserRequest $request)
    {
        $employee = $this->employeeService->store($request->validated()); // ✅ استخدام store بدلاً من createEmployee
        return Helpers::jsonResponse(
            true,
            'تم إنشاء الموظف بنجاح',
            $employee,
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        if (!$employee) {
            return Helpers::jsonResponse(false, 'الموظف غير موجود', null, Response::HTTP_NOT_FOUND);
        }

        return Helpers::jsonResponse(true, 'تم استرجاع بيانات الموظف بنجاح', $employee, Response::HTTP_OK);
    }


    /**
     * تحديث بيانات الموظف.
     */
    public function update(UpdateEmployeeRequest $request, $id)
{
    // جلب الموظف من الخدمة
    $employee = $this->employeeService->getEmployeeById($id);

    if (!$employee) {
        return Helpers::jsonResponse(false, 'الموظف غير موجود', null, Response::HTTP_NOT_FOUND);
    }

    // تحديث الموظف باستخدام البيانات المرسلة
    $updatedEmployee = $this->employeeService->update($employee, $request->validated());

    return Helpers::jsonResponse(
        true,
        'تم تحديث بيانات الموظف بنجاح',
        $updatedEmployee,
        Response::HTTP_OK
    );
}
    /**
     * جلب معاملات الموظف.
     */
    public function transactions($id)
    {
        $transactions = $this->employeeService->getEmployeeTransactions($id);
        if (is_null($transactions)) {
            return Helpers::jsonResponse(false, 'الموظف غير موجود', null, Response::HTTP_NOT_FOUND);
        }
        return Helpers::jsonResponse(true, 'تم جلب جميع المعاملات بنجاح', $transactions, Response::HTTP_OK);
    }

    /**
     * جلب رسائل الموظف.
     */
    public function messages($id)
    {
        $messages = $this->employeeService->getEmployeeMessages($id);
        if (is_null($messages)) {
            return Helpers::jsonResponse(false, 'الموظف غير موجود', null, Response::HTTP_NOT_FOUND);
        }
        return Helpers::jsonResponse(true, 'تم جلب جميع الرسائل بنجاح', $messages, Response::HTTP_OK);
    }
}
