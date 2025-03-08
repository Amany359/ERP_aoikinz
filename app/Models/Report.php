<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'supervisor_id', 'engineer_id', 'contractor_id',
        'project_name',
        'project_address',
        'report_title',
        'summary',
        'image',
        'daily_report',
        'report_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function engineer()
    {
        return $this->belongsTo(Engineer::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }
}
