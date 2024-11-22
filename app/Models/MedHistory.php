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
        'do_AEE',
        'class_AEE',
        'study',
        'name_mother',
        'date_mother',
        'rg_mother',
        'profession_mother',
        'name_father',
        'date_father',
        'rg_father',
        'profession_father',
        'address',
        'cellphone',
        'have_medication',
        'what_medication',
        'compplaint',
        'who_lives',
        'state_parents_relation',
        'time_state_relation',
        'new_relation_mother',
        'time_new_relation_mother',
        'lives_new_relation_mother',
        'new_relation_father',
        'time_new_relation_father',
        'lives_new_relation_father',
        'have_kinship_parents',
        'what_kinship_parents'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
