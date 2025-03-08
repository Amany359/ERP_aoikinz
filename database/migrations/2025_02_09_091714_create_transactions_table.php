<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // معرف المعاملة (Primary Key)
           
            $table->string('type', 20); // نوع المعاملة (بدلاً من ENUM)
            $table->decimal('amount', 10, 2); // قيمة المعاملة
            $table->string('status', 20); // حالة المعاملة (بدلاً من ENUM)
            $table->timestamps(); // تاريخ المعاملة
            $table->foreignId('supervisor_id')->nullable()->constrained('supervisors')->onDelete('set null');
            $table->foreignId('engineer_id')->nullable()->constrained('engineers')->onDelete('set null');
            $table->foreignId('contractor_id')->nullable()->constrained('contractors')->onDelete('set null');
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null'); // معرف الموظف (Foreign Key)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
