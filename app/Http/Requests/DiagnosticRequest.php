<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DiagnosticRequest extends FormRequest
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
        $diagnosticId = $this->route('diagnostic');

        $rules = [
            'name' => [
                'required',
                'min:1',
                'max:255',
                Rule::unique('students')->ignore($diagnosticId),
            ],
        ];
        
        return $rules;
    }
}
