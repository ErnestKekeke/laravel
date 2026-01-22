<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'file_path',
        'submitted_at',
        'status',
        'score',
        'feedback',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    // Relationships
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Helper methods
    public function isLate()
    {
        return $this->submitted_at > $this->assignment->due_date;
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'submitted' => 'badge-success',
            'late' => 'badge-warning',
            'graded' => 'badge-info',
            default => 'badge-secondary',
        };
    }
}