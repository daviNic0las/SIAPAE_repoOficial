<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $state = 'attendances';
    protected $fillable = [
        'student_id',
        'date',
        'educational_axis',
        'advances',
        'difficulties',
        'signature'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id'); 
    }
}
