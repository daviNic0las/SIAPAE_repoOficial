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
        'class',
        'student_id',
        'school',
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
    public function donation(): HasMany
    {
        return $this->hasMany(Donation::class, 'student_id');
    }
}
