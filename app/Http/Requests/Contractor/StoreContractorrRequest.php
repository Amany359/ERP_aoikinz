<?php

namespace App\Http\Requests\Contractor;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractorrRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'start_date' => 'required|date',
            'work_hours' => 'required|integer|min:1',
            'balance' => 'required|numeric|min:0',
            'debt' => 'required|numeric|min:0',
            'kenz_card_status' => 'sometimes|boolean',
        ];
}
}