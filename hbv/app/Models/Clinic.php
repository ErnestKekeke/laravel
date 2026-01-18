<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Clinic extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'clinic_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clinic_id',
        'clinic_name',
        'clinic_type',
        'reg_no',
        'lic_issue_dt',
        'accred_status',
        'med_dir',
        'email',
        'contact_no',
        'address',
        'country',
        'state',
        'city',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'lic_issue_dt' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the patients for the clinic.
     */
    public function patients()
    {
        return $this->hasMany(Patient::class, 'clinic_id', 'clinic_id');
    }

    /**
     * Get active patients count.
     *
     * @return int
     */
    public function getActivePatientsCountAttribute()
    {
        return $this->patients()->count();
    }

    /**
     * Get HBV positive patients count.
     *
     * @return int
     */
    public function getHbvPositivePatientsCountAttribute()
    {
        return $this->patients()->where('hbsag', 'positive')->count();
    }

    /**
     * Get patients on treatment count.
     *
     * @return int
     */
    public function getPatientsOnTreatmentCountAttribute()
    {
        return $this->patients()->where('treatment_status', 'on_treatment')->count();
    }

    /**
     * Check if clinic is accredited.
     *
     * @return bool
     */
    public function isAccredited()
    {
        return $this->accred_status === 'accredited';
    }

    /**
     * Scope a query to only include accredited clinics.
     */
    public function scopeAccredited($query)
    {
        return $query->where('accred_status', 'accredited');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'clinic_id';
    }
}