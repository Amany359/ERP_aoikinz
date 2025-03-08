<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
         'phone',
        'profession',
        'identity_image',
        'work_permit_image',
        'role',
        'is_verified',
        'verification_code',
        'verification_code_expires_at',
        'reset_password_token', // رمز إعادة تعيين كلمة المرور
        'reset_password_expires_at', // صلاحية رمز إعادة التعيين
        

    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',

        'verification_code',
        'reset_password_token', //
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];



        
    }

    // علاقة المستخدم بالتقارير
    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id');
    }




     
 
     // الرسائل التي أرسلها المستخدم
     public function sentMessages()
     {
         return $this->hasMany(Message::class, 'sender_id');
     }
 
     // الرسائل التي استقبلها المستخدم
     public function receivedMessages()
     {
         return $this->hasMany(Message::class, 'receiver_id');
     }
 }

