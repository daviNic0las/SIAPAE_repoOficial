<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    use HasFactory;
    protected $state = 'regionals';
    protected $fillable = [
        'title',
        'subtitle',
        'text',
        'signature',
        'date',
    ];
}
