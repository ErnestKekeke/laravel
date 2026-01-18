<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Clinic Relationship
        'clinic_id',
        
        // Personal Information
        'patient_id',
        'first_name',
        'last_name',
        'middle_name',
        'date_of_birth',
        'gender',
        'photo_path',
        
        // Contact Information
        'phone',
        'email',
        'address',
        'country',
        'state',
        'city',
        'postal_code',
        
        // Laboratory Results
        'test_date',
        'hbsag',
        'anti_hbs',
        'hbeag',
        'viral_load',
        'alt_level',
        'ast_level',
        'platelet_count',
        'lab_notes',
        
        // Treatment Information
        'diagnosis_type',
        'treatment_status',
        'vaccination_status',
        'prescribed_medication',
        'next_appointment',
        'doctor_name',
        'treatment_notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'test_date' => 'date',
        'next_appointment' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the clinic that owns the patient.
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'clinic_id');
    }

    /**
     * Get the patient's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    /**
     * Get the patient's age.
     *
     * @return int
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth->age;
    }

    /**
     * Get the patient's photo URL.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }
        
        // Return default avatar based on gender
        return $this->gender === 'male' 
            ? asset('images/default-male-avatar.png')
            : asset('images/default-female-avatar.png');
    }

    /**
     * Check if patient is HBV positive.
     *
     * @return bool
     */
    public function isHbvPositive()
    {
        return $this->hbsag === 'positive';
    }

    /**
     * Check if patient is on treatment.
     *
     * @return bool
     */
    public function isOnTreatment()
    {
        return $this->treatment_status === 'on_treatment';
    }

    /**
     * Check if patient is fully vaccinated.
     *
     * @return bool
     */
    public function isFullyVaccinated()
    {
        return $this->vaccination_status === 'fully_vaccinated';
    }

    /**
     * Scope a query to only include HBV positive patients.
     */
    public function scopeHbvPositive($query)
    {
        return $query->where('hbsag', 'positive');
    }

    /**
     * Scope a query to only include patients on treatment.
     */
    public function scopeOnTreatment($query)
    {
        return $query->where('treatment_status', 'on_treatment');
    }

    /**
     * Scope a query to filter patients by clinic.
     */
    public function scopeByClinic($query, $clinicId)
    {
        return $query->where('clinic_id', $clinicId);
    }

    /**
     * Boot method to auto-generate patient ID.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            if (empty($patient->patient_id)) {
                $patient->patient_id = static::generatePatientId($patient->clinic_id);
            }
        });
    }

    /**
     * Generate unique patient ID.
     *
     * @param string $clinicId
     * @return string
     */
    public static function generatePatientId($clinicId)
    {
        $year = date('Y');
        
        // Get last patient for this clinic
        $lastPatient = static::where('clinic_id', $clinicId)
            ->whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
        
        $number = $lastPatient ? ((int) substr($lastPatient->patient_id, -4)) + 1 : 1;
        
        // Format: CLINICID-YEAR-0001
        return strtoupper($clinicId) . '-' . $year . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}