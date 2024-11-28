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
        $MedHistoryId = $this->route('anamnesi'); 
        // Captura o id da rota e está estranha pois o id de anamnesis é {anamnesi}

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
            'informant' => 'required|string|max:255',
            'date_of_anamnesis' => 'required|min:8',
            'appraisal' => 'required|string|max:255',
            'have_caregiver' => 'sometimes|boolean',
            'have_AEE' => 'sometimes|boolean',
            'turn_AEE' => 'nullable|string|max:255',
            'study' => 'nullable|string|max:255',
            'name_mother' => 'required|string',
            'date_mother' => 'required|min:8',
            'rg_mother' => 'required|string|max:255',
            'profession_mother' => 'required|string|max:255',
            'cellphone_mother' => 'nullable|string|max:15',
            'name_father' => 'required|string',
            'date_father' => 'required|min:8',
            'rg_father' => 'required|string|max:255',
            'profession_father' => 'required|string|max:255',
            'cellphone_father' => 'nullable|string|max:15',
            'address' => 'required|string|max:255',
            'have_medication' => 'sometimes|boolean',
            'what_medication' => 'nullable|string|max:255',
            'compplaint' => 'nullable|string|max:1024',
            'who_lives' => 'required|string|max:255',
            'state_parents_relation' => 'required|string|max:255',
            'time_state_relation' => 'nullable|string|max:255',
            'new_relation_mother' => 'sometimes|boolean',
            'time_new_relation_mother' => 'nullable|string|max:255',
            'lives_together_new_relation_mother' => 'nullable|string|max:255',
            'new_relation_father' => 'sometimes|boolean',
            'time_new_relation_father' => 'nullable|string|max:255',
            'lives_together_new_relation_father' => 'nullable|string|max:255',
            'have_kinship_parents' => 'sometimes|boolean',
            'what_kinship_parents' => 'nullable|string',
            'have_child_desired' => 'nullable|string',
            'gestation_order' => 'nullable|string',
            'number_children' => 'nullable|integer',
            'history_abort' => 'nullable|boolean',
            'abort_justify' => 'nullable|string',
            'have_child_adopted' => 'nullable|string',
            'have_pre_natal' => 'nullable|string',
            'time_gestation' => 'nullable|string',
            'type_childbirth' => 'nullable|string',
            'have_disease_gestation' => 'nullable|boolean',
            'what_disease_gestation' => 'nullable|string',
            'have_treatment' => 'nullable|string',
            'place_birth' => 'nullable|string',
            'have_problems_birth' => 'nullable|boolean',
            'what_problems_birth' => 'nullable|string',
            'have_discharged_together' => 'nullable|boolean',
            'detail_discharged_together' => 'nullable|string',
            'have_neonatal_tests' => 'nullable|boolean',
            'result_neonatal_tests' => 'nullable|string',
            'detail_neonatal_tests' => 'nullable|string',
            'have_mother_breastfeed' => 'nullable|string',
            'have_nozzle' => 'nullable|boolean',
            'detail_nozzle' => 'nullable|string',
            'have_up_to_date_vaccines' => 'nullable|boolean',
            'detail_up_to_date_vaccines' => 'nullable|string',
            'have_delay_NPM' => 'nullable|boolean',
            'detail_delay_NPM' => 'nullable|string',
            'have_normal_development' => 'nullable|boolean',
            'detail_normal_development' => 'nullable|string',
            'have_desfrald_yet' => 'nullable|boolean',
            'age_desfrald_yet' => 'nullable|string',
            'have_sphincters_control' => 'nullable|boolean',
            'age_sphincters_control' => 'nullable|string',
            'bites_nails' => 'nullable|string',
            'hurt_yourself' => 'nullable|string',
            'state_sleep' => 'nullable|string',
            'sleeps_in_separate' => 'nullable|string',
            'sleep_time' => 'nullable|string',
            'difficulty_waking_up' => 'nullable|string',
            'independent_daily_activities' => 'nullable|string',
            'other_difficulty' => 'nullable|string',
        ];

        return $rules;
    }

}
