<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        Employee::insert([
            [
                'name' => 'أحمد علي',
                'status' => 'active',
                'start_date' => Carbon::parse('2023-01-15'),
                'work_hours' => 40,
                'balance' => 5000,
                'debt' => 200,
                'kenz_card_status' => true, // valid -> true
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'محمد سعيد',
                'status' => 'inactive',
                'start_date' => Carbon::parse('2022-12-10'),
                'work_hours' => 35,
                'balance' => 4200,
                'debt' => 0,
                'kenz_card_status' => false, // expired -> false
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سارة حسن',
                'status' => 'active',
                'start_date' => Carbon::parse('2024-05-01'),
                'work_hours' => 45,
                'balance' => 6000,
                'debt' => 500,
                'kenz_card_status' => true, // valid -> true
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
