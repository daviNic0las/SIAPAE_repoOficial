<?php

namespace App\Models;

use App\Events\StudentCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $state = 'students';
    protected $fillable = [
        'name',
        'date_of_birth',
        'diagnostic_id',
        'student_id',
        'school',
        'class_school',
        'turn_school',
        'grade_school',
        'class_apae',
        'turn_apae',
        'image',
    ];
    
    protected $dispatchesEvents = [ 
        'created' => StudentCreated::class, 
    ];

    public function diagnostic(): BelongsTo
    {
        return $this->belongsTo(Diagnostic::class, 'diagnostic_id')->withDefault([ 
        'name' => 'Diagnóstico não encontrado'
    ]); // Permitir valor default caso null
    }
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'student_id');
    }
    public function MedHistory(): BelongsTo
    {
        return $this->belongsTo(MedHistory::class, 'student_id');
    }
}
