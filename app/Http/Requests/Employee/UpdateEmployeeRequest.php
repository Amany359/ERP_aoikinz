<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'status' => 'required|in:active,inactive', // استخدام القيم الصحيحة المتوافقة مع قاعدة البيانات
            'start_date' => 'required|date',
            'work_hours' => 'required|integer',
            'balance' => 'required|numeric',
            'debt' => 'required|numeric',
            'kenz_card_status' => 'required|boolean',
        ];
        
    }
}
