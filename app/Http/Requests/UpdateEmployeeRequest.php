<?php

namespace App\Http\Requests;

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
            'email' => 'required|email|max:255|unique:App\Models\Employee,email,'.$this->employee->id,
            'phone' => 'required|max:20',
            'address' => ['required','max:255'],
            'department_id' => ['required','integer'],
            'achievement_name' => ['array'],
            'achievement_date' => ['array'],
        ];
    }

    public function messages(): array
    {
        return [
            'department_id.integer' => 'Select Department',
        ];
    }

}
