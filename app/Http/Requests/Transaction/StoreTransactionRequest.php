<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id'  => 'nullable|exists:employees,id',
            'contractor_id' => 'nullable|exists:contractors,id',
            'supervisor_id' => 'nullable|exists:supervisors,id',
            'engineer_id'   => 'nullable|exists:engineers,id',
            'type'         => 'required|in:سُلفة,دين',
            'amount'       => 'required|numeric|min:0.01',
            'status'       => 'required|in:مدفوع,متبقي',
        ];
    }
}
