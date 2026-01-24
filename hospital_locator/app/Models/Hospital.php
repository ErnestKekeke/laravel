<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals';

    // Mass assignable fields
    protected $fillable = [
        'hospital_name',
        'hospital_type',
        'reg_no',
        'lic_issue_dt',
        'accred_status',
        'med_dir',
        'ownership',
        'beds',
        'email',
        'contact_no',
        'address',
        'country',
        'state',
        'city',
        'zipcode',
        'latitude',
        'longitude',
        'logo_path', // updated
    ];

    // Casts
    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
        'beds'      => 'integer',
    ];

    protected $dates = [
        'lic_issue_dt',
        'created_at',
        'updated_at',
    ];

    // Accessor for full address
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state}, {$this->country}";
    }

    // Accessor for logo URL
    public function getLogoUrlAttribute()
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }
}
