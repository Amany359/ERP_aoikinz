<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Transaction extends Model
{
    use HasFactory,HasApiTokens;

   
        
    
        protected $fillable = [
            'type',
            'amount',
            'status',
            'supervisor_id',
            'engineer_id',
            'contractor_id',
            'employee_id',
        ];
    
        // علاقة مع المشرف
        public function supervisor()
        {
            return $this->belongsTo(Supervisor::class);
        }
    
        // علاقة مع المهندس
        public function engineer()
        {
            return $this->belongsTo(Engineer::class);
        }
    
        // علاقة مع المقاول
        public function contractor()
        {
            return $this->belongsTo(Contractor::class);
        }
    
        // علاقة مع الموظف
        public function employee()
        {
            return $this->belongsTo(Employee::class);
        }

        
    }
    