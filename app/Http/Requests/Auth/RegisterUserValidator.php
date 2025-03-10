<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|unique:users',
            'profession' => 'required|string|max:255',
            'identity_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'work_permit_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:employee,supervisor,contractor,engineer', 
        ];
    }
}
