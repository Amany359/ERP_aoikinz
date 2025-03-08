<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // يجب أن يكون true للسماح بتنفيذ الطلب
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'language'  => 'required|string|in:ar,en,fr',
            'dark_mode' => 'required|boolean',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'language.required' => 'اللغة مطلوبة.',
            'language.in'       => 'اللغة يجب أن تكون إما "ar" أو "en" أو "fr".',
            'dark_mode.required'=> 'حقل الوضع الليلي مطلوب.',
            'dark_mode.boolean' => 'حقل الوضع الليلي يجب أن يكون صحيح أو خطأ.',
        ];
    }
}
