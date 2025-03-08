<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // عرض جميع الأقسام
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    // تخزين قسم جديد
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:departments']);

        $department = Department::create(['name' => $request->name]);

        return response()->json(['message' => 'تم إنشاء القسم بنجاح', 'department' => $department], 201);
    }

    // تحديث قسم
    public function update(Request $request, Department $department)
    {
        $request->validate(['name' => 'required|unique:departments,name,' . $department->id]);

        $department->update(['name' => $request->name]);

        return response()->json(['message' => 'تم تحديث القسم بنجاح']);
    }

    // حذف قسم
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(['message' => 'تم حذف القسم بنجاح']);
    }
}
