<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    use HasFactory;

    // تحديد اسم الجدول (اختياري إذا كان اسم الجدول هو الجمع التلقائي "engineers")
    protected $table = 'engineers';

    // الحقول القابلة للتعبئة (fillable) التي يمكن تحديثها عبر الـ Mass Assignment
    protected $fillable = [
        'name', 'status', 'start_date', 'work_hours', 'balance', 'debt', 'kenz_card_status'
    ];

    // العلاقة مع موديل الـ User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

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
