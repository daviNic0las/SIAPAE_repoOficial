<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $studentId = $this->route('student'); // Captura o id da rota

        $rules = [
            'name' => [
                'required',
                'min:1',
                'max:255',
                Rule::unique('students')->ignore($studentId),
            ],
            'date_of_birth' => 'required|min:1',
            'diagnostic_id' => 'required|min:1|max:255',
            'class' => 'required|min:1|max:255',
            'student_id' => [
                'required',
                'min:1',
                Rule::unique('students')->ignore($studentId),
            ],
            'school' => 'required|min:1|max:255',
            'image => nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ];
        
        return $rules;
    }
}
