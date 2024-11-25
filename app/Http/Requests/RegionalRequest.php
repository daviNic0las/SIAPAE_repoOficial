<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionalRequest extends FormRequest
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
        $rules = [
            'date' => 'required|min:1',
            'title' => 'required|string|min:1|max:100',
            'subtitle' => 'required|string|min:1|max:200',
            'text' => 'required|string|min:1|max:7000',
            'signature' => 'required|string|min:1|max:100',
        ];
        
        return $rules;
    }
}
