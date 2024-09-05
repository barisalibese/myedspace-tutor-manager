<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'subjects' => 'array',
    ];

    protected $fillable = [
        'avatar',
        'name',
        'email',
        'hourly_rate',
        'bio',
        'subjects',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, TutorStudent::class);
    }
}
