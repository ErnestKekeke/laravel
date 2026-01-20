<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
        'name',
        'location',
        'project_id',
        'assistance_type'
    ];

    /**
     * Get the project this beneficiary belongs to
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get total count of beneficiaries
     */
    public static function getTotalCount()
    {
        return self::count();
    }
}