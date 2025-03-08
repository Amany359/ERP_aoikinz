<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\EngineerController;
use App\Http\Controllers\Api\ContractorController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\DepartmentController;



Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/verify', [AuthController::class, 'verifyAccount']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    

    // المسار الذي يعيد المستخدم المصادق عليه
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::post('auth/logout', [AuthController::class, 'logout']);
    
// إدارة الموظفين
Route::apiResource('employees', EmployeeController::class);

Route::get('/employees/{id}/transactions', [EmployeeController::class, 'transactions']);
Route::get('/employees/{id}/messages', [EmployeeController::class, 'messages']);

Route::apiResource('Supervisor', SupervisorController::class);
Route::prefix('supervisor')->group(function () {
    Route::get('{id}/messages', [SupervisorController::class, 'messages']);
    Route::get('{id}/transactions', [SupervisorController::class, 'transactions']);
    Route::get('{id}/reports', [SupervisorController::class, 'reports']);
}); // تأكد من إغلاق ال

Route::apiResource('Engineer', EngineerController::class);
Route::apiResource('Contractor', ContractorController::class);

    // إرسال رسالة
    Route::post('/messages', [MessageController::class, 'store']);

    // جلب جميع الرسائل حسب الدور
    Route::get('/messages', [MessageController::class, 'index']);

    Route::post('/reports', [ReportController::class, 'store']); // إنشاء تقرير جديد
    Route::get('/reports', [ReportController::class, 'index']);  // عرض التقارير الخاصة بالمستخدم

    Route::apiResource('departments', DepartmentController::class);

Route::apiResource('transactions', TransactionController::class);

    Route::get('/settings', [SettingController::class, 'show']);
    Route::put('/settings/{id}', [SettingController::class, 'update']);
    Route::post('/settings', [SettingController::class, 'store']);

});
