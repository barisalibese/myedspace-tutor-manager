<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorStudent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tutor_id',
        'student_id',
    ];
}
