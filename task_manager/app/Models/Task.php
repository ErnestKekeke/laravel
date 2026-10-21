<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'priority', 'project_id'];

    // Defines a many-to-one relationship with the Project model.
    public function project()
    {
        // Returns the project linked to this task using belongsTo().
        return $this->belongsTo(Project::class);
    }
}
