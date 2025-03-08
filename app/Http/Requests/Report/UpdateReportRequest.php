<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_name' => 'required|string|max:255',
            'project_address' => 'required|string|max:255',
            'report_title' => 'required|string|max:255',
            'summary' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'daily_report' => 'required|string',
            'report_date' => 'required|date',
            'supervisor_id' => 'nullable|integer|exists:supervisors,id',
            'engineer_id' => 'nullable|integer|exists:engineers,id',
            'contractor_id' => 'nullable|integer|exists:contractors,id',
        ];
    }
}
