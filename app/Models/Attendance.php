<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        '',
        'signature',
        'date_of_attendance'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id'); 
    }
}
