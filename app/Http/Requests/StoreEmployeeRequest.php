<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'email' => 'required|email|unique:App\Models\Employee,email|max:255',
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
