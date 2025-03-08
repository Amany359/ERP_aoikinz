<?php

namespace App\Http\Requests\Supervisor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupervisorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:active,inactive',
            'start_date' => 'sometimes|date',
            'work_hours' => 'sometimes|integer|min:0',
            'balance' => 'sometimes|numeric',
            'debt' => 'sometimes|numeric',
            'kenz_card_status' => 'sometimes|boolean',
        ];
    }
}
