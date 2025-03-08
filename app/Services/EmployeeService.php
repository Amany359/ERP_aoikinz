<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getAllEmployees()
    {
        return Employee::all();
    }

    public function getEmployeeById($id)
    {
        return Employee::find($id); // ✅ التأكد من إرجاع الموظف
    }

    public function createEmployee(array $data)
    {
        return Employee::create($data);
    }

    
    public function store(array $data)
    {
        return Employee::create($data); // ✅ استبدال Supervisor بـ Employee
    }

    public function update(Employee $employee, array $data) // ✅ تعديل لتلقي البيانات كـ array
{
    $employee->update($data);
    return $employee;
}
    /**
     * جلب معاملات الموظف باستخدام العلاقة.
     */
    public function getEmployeeTransactions($id)
    {
        $employee = Employee::with('transactions')->find($id);
        return $employee ? $employee->transactions : null; // ✅ تحسين التحقق
    }

    /**
     * جلب رسائل الموظف باستخدام العلاقة.
     */
    public function getEmployeeMessages($id)
    {
        $employee = Employee::with('messages')->find($id);
        return $employee ? $employee->messages : null; // ✅ تحسين التحقق
    }
}
