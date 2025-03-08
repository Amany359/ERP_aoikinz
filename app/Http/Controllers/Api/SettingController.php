<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSettingRequest;
use App\Services\SettingService;
use App\Helpers\Helpers;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function show()
    {
        $settings = $this->settingService->getSettings();
        return Helpers::jsonResponse(true, $settings, 'تم جلب الإعدادات بنجاح');
    }

    public function update(StoreSettingRequest $request)
    {
        $settings = $this->settingService->updateSettings($request->validated());
        return Helpers::jsonResponse(true, $settings, 'تم تحديث الإعدادات بنجاح');
    }

    // إضافة دالة store لتخزين الإعدادات
    public function store(StoreSettingRequest $request)
    {
        // تخزين الإعدادات باستخدام SettingService
        $settings = $this->settingService->storeSettings($request->validated());
        
        return Helpers::jsonResponse(true, $settings, 'تم حفظ الإعدادات بنجاح');
    }
}
