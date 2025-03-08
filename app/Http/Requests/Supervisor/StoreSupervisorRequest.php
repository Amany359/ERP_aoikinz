<?php

namespace App\Http\Requests\Supervisor;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupervisorRequest extends FormRequest
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
            'status' => 'required|in:active,inactive',
            'start_date' => 'required|date',
            'work_hours' => 'required|integer|min:0',
            'balance' => 'required|numeric',
            'debt' => 'required|numeric',
            'kenz_card_status' => 'boolean',
        ];
    }
}
