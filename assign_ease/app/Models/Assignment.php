<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturer_id',
        'title',
        'description',
        'course_code',
        'course_title',
        'due_date',
        'total_marks',
        'file_path',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }

    // Relationships
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // Helper methods
    public function isOverdue()
    {
        return $this->due_date < now();
    }

    public function getSubmissionCount()
    {
        return $this->submissions()->count();
    }
}