<?php

namespace App\Services;

use App\Models\User;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AuthService
{
    use UploadImageTrait; // ✅ تضمين الـ Trait

    /**
     * تسجيل مستخدم جديد
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data)
    {
        // ✅ رفع الصور باستخدام الـ Trait
        $identityPath = $this->uploadImage($data['identity_image'], 'identity_images');
        $workPermitPath = $this->uploadImage($data['work_permit_image'], 'work_permits');

        // ✅ إنشاء رمز التحقق
        $verificationCode = rand(100000, 999999);

        // ✅ إنشاء المستخدم
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'profession' => $data['profession'],
            'identity_image' => $identityPath,
            'work_permit_image' => $workPermitPath,
            'password' => Hash::make($data['password']),
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => now()->addMinutes(15),
            'role' => $data['role'], //
        ]);
    }

    /**
     * توثيق الحساب عبر رمز التحقق
     *
     * @param array $data
     * @return string
     */
    public function verifyAccount(array $data)
    {
        $user = User::where('phone', $data['phone'])
            ->where('verification_code', $data['verification_code'])
            ->where('verification_code_expires_at', '>', now())
            ->first();

        if (!$user) {
            return ['success' => false, 'message' => 'رمز التحقق غير صالح أو منتهي الصلاحية.'];
        }

        $user->update([
            'is_verified' => true,
            'verification_code' => null,
            'verification_code_expires_at' => null
        ]);

        return ['success' => true, 'message' => 'تم توثيق الحساب بنجاح. يمكنك الآن تسجيل الدخول.'];
    }

    /**
     * تسجيل الدخول
     *
     * @param array $data
     * @return array
     */
    public function loginUser(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return ['success' => false, 'message' => 'بيانات تسجيل الدخول غير صحيحة.'];
        }

        if (!$user->is_verified) {
            return ['success' => false, 'message' => 'يجب توثيق الحساب قبل تسجيل الدخول.'];
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['success' => true, 'token' => $token, 'message' => 'تم تسجيل الدخول بنجاح.'];
    }

    /**
     * تسجيل الخروج
     *
     * @return string
     */
    public function logoutUser()
    {
        Auth::user()->tokens()->delete();
        return 'تم تسجيل الخروج بنجاح.';
    }


    public function sendResetCode($email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return ['success' => false, 'message' => 'البريد الإلكتروني غير مسجل.'];
        }

        $token = Str::random(6); // إنشاء رمز عشوائي
        $user->reset_token = $token;
        $user->save();

        // إرسال الرمز عبر البريد أو SMS (يمكنك التعديل حسب احتياجاتك)
        // Mail::to($user->email)->send(new ResetPasswordMail($token));

        return ['success' => true, 'message' => 'تم إرسال رمز التحقق إلى البريد الإلكتروني.'];
    }

    public function resetPassword($data)
{
    $user = User::where('email', $data['email'])
                ->where('reset_token', $data['token'])
                ->first();

    if (!$user) {
        return ['success' => false, 'message' => 'الرمز غير صحيح أو البريد الإلكتروني غير مسجل.'];
    }

    // تحديث كلمة المرور وحذف التوكن
    $user->password = Hash::make($data['password']);
    $user->reset_token = null; 
    $user->save();

    // حذف جميع التوكنات القديمة لمنع الوصول الغير مصرح به
    $user->tokens()->delete();

    // إنشاء توكن جديد بعد تغيير كلمة المرور
    $newToken = $user->createToken('auth_token')->plainTextToken;

    return [
        'success' => true,
        'message' => 'تم تغيير كلمة المرور بنجاح.',
        'token' => $newToken // ✅ إرجاع التوكن الجديد
    ];
}


}
