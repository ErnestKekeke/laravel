<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    // // Defines a one-to-many relationship with tasks.
    public function tasks()
    {
        // Returns all tasks linked to this project using hasMany().
        return $this->hasMany(Task::class);
    }
}
