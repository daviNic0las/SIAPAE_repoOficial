<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedHistory extends Model
{
    use HasFactory;
    protected $state = 'med_histories';
    protected $fillable = [
        'informant',
        'date_of_anamnesis',
        'student_id',
        'appraisal',
        'have_caregiver',
        'have_AEE',
        'turn_AEE',
        'not_study_justify',
        'name_mother',
        'date_mother',
        'rg_mother',
        'profession_mother',
        'cellphone_mother',
        'name_father',
        'date_father',
        'rg_father',
        'profession_father',
        'cellphone_father',
        'address',
        'have_medication',
        'what_medication',
        'compplaint',
        'who_lives',
        'state_parents_relation',
        'time_state_relation',
        'new_relation_mother',
        'time_new_relation_mother',
        'lives_together_new_relation_mother',
        'new_relation_father',
        'time_new_relation_father',
        'lives_together_new_relation_father',
        'have_kinship_parents',
        'what_kinship_parents',
        'have_child_desired',
        'gestation_order',
        'number_children',
        'history_abort',
        'abort_justify',
        'have_child_adopted',
        'have_pre_natal',
        'time_gestation',
        'type_childbirth',
        'have_disease_gestation',
        'what_disease_gestation',
        'have_treatment',
        'place_birth',
        'have_problems_birth',
        'what_problems_birth',
        'have_discharged_together',
        'detail_discharged_together',
        'have_neonatal_tests',
        'result_neonatal_tests',
        'detail_neonatal_tests',
        'have_mother_breastfeed',
        'have_nozzle',
        'detail_nozzle',
        'have_up_to_date_vaccines',
        'detail_up_to_date_vaccines',
        'have_delay_NPM',
        'detail_delay_NPM',
        'have_normal_development',
        'detail_normal_development',
        'have_desfrald_yet',
        'age_desfrald_yet',
        'have_sphincters_control',
        'age_sphincters_control',
        'bites_nails',
        'hurt_yourself',
        'state_sleep',
        'sleeps_in_separate',
        'sleep_time',
        'difficulty_waking_up',
        'independent_daily_activities',
        'other_difficulty'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
