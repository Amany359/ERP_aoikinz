<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    // دالة لتخزين الإعدادات
    public function storeSettings(array $data)
    {
        // هنا تقوم بتخزين الإعدادات في قاعدة البيانات
        $settings = Setting::create($data);

        return $settings;
    }

    // دالة أخرى موجودة بالفعل
    public function getSettings()
    {
        return Setting::all(); // أو أي منطق آخر لجلب الإعدادات
    }

    public function updateSettings(array $data)
    {
        $settings = Setting::find(1); // فرضًا أنك تجد الإعدادات من جدول واحد فقط
        $settings->update($data);

        return $settings;
    }
}
