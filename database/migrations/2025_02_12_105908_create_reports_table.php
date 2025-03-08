<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // معرف التقرير
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // المستخدم الذي أنشأ التقرير
        
            // معلومات المشروع
            $table->string('project_name');
            $table->string('project_address');
            $table->string('report_title');
            $table->text('summary');
        
            // تفاصيل التقرير
            $table->string('image')->nullable();
            $table->text('daily_report');
            $table->date('report_date');
        
            // إضافة العلاقات بعد user_id لتوضيح الترتيب
            $table->bigInteger('supervisor_id')->unsigned()->nullable();
            $table->bigInteger('engineer_id')->unsigned()->nullable();
            $table->bigInteger('contractor_id')->unsigned()->nullable();

            $table->timestamps(); // تاريخ الإنشاء والتحديث
            $table->softDeletes(); // دعم الحذف المؤقت (اختياري)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
