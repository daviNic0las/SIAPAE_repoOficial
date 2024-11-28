<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedHistoryRequest extends FormRequest
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
     //DICA: use cntrl+H para BUSCAR um CAMPO ESPECÍFICO
    public function rules(): array
    {
        $MedHistoryId = $this->route('student'); // Captura o id da rota

        $rules = [
            'informant' => [
                'required',
                'string',
                'max:255'
            ],
            'date_of_anamnesis' => [
                'required',
                'min:8'
            ],

            'student_id' => [
                'required',
                'min:1',
                Rule::unique('med_histories')->ignore($MedHistoryId),
            ],

            'appraisal' => [
                'required',
                'string',
                'max:255'
            ],

            'have_caregiver' => [
                'required',
                'boolean',
            ],

            'do_AEE' => [
                'required',
                'boolean',
            ],

            'class_AEE' => [
                'nullable',
                'string',
                'max:255'
            ],

            'study' => [
                'nullable',
                'string',
                'max:255'
            ],

            'name_mother' => [
                'required',
                'string'
            ],

            'date_mother' => [
                'required',
                'min:8'
            ],

            'rg_mother' => [
                'required',
                'string',
                'max:255'
            ],

            'profession_mother' => [
                'required',
                'string',
                'max:255'
            ],

            'name_father' => [
                'required',
                'string'
            ],

            'date_father' => [
                'required',
                'min:8'
            ],

            'rg_father' => [
                'required',
                'string',
                'max:255'
            ],

            'profession_father' => [
                'required',
                'string',
                'max:255'
            ],

            'address' => [
                'required',
                'string',
                'max:255'
            ],

            'cellphone' => [
                'required',
                'string',
                'max:15'
            ],

            'have_medication' => [
                'required',
                'boolean',
            ],

            'what_medication' => [
                'nullable',
                'string',
                'max:255'
            ],

            'compplaint' => [
                'nullable',
                'string',
                'max:255'
            ],

            'who_lives' => [
                'required',
                'string',
                'max:255'
            ],

            'state_parents_relation' => [
                'required',
                'string',
                'max:255'
            ],

            'time_state_relation' => [
                'nullable',
                'string',
                'max:255'
            ],

            'new_relation_mother' => [
                'required',
                'boolean',
            ],

            'time_new_relation_mother' => [
                'nullable',
                'string',
                'max:255'
            ],

            'lives_new_relation_mother' => [
                'nullable',
                'string',
                'max:255'
            ],

            'new_relation_father' => [
                'required',
                'boolean',
            ],

            'time_new_relation_father' => [
                'nullable',
                'string',
                'max:255'
            ],

            'lives_new_relation_father' => [
                'nullable',
                'string',
                'max:255'
            ],

            'have_kinship_parents' => [
                'required',
                'boolean',
            ],

            'what_kinship_parents' => [
                'nullable',
                'string'
            ],
        ];

        return $rules;
    }

}
