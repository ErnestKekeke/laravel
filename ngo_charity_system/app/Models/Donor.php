<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    /**
     * Get all donations for this donor
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Find or create a donor by email
     */
    public static function findOrCreateByEmail($email, $data)
    {
        $donor = self::where('email', $email)->first();
        
        if (!$donor) {
            $donor = self::create($data);
        }
        
        return $donor;
    }
}