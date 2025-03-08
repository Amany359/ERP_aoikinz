<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Employee extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'status',
        'start_date',
        'work_hours',
        'balance',
        'debt',
        'kenz_card_status',
    ];

    

    // علاقة المشرف بالمعاملات (مشرف واحد لديه عدة معاملات)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'contractor_id');
    }
}
