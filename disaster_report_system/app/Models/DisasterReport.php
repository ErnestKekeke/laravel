<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'disaster_type_id',
        'reporter_name',
        'reporter_phone',
        'location',
        'description',
        'severity',
        'status',
    ];

    public function disasterType()
    {
        return $this->belongsTo(DisasterType::class);
    }
}