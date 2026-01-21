<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function disasterReports()
    {
        return $this->hasMany(DisasterReport::class);
    }
}