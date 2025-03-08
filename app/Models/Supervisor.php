<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    // جدول المشرفين
    protected $table = 'supervisors';

    // الحقول القابلة للملء (mass assignable)
    protected $fillable = [
        'name', 'status', 'start_date', 'work_hours', 'balance', 'debt', 'kenz_card_status'
    ];

    // علاقة supervisor مع user
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
