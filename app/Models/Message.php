<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'role',
        'read_at'
    ];

    /**
     * علاقة المرسل (User) مع الرسالة.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * علاقة المستقبل (User) مع الرسالة.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

}
