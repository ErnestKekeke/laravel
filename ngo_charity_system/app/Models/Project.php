<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'target_amount',
        'raised_amount',
        'status'
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2'
    ];

    /**
     * Get all beneficiaries for this project
     */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    /**
     * Get active projects
     */
    public static function getActiveProjects($limit = null)
    {
        $query = self::where('status', 'active');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        return $query->get();
    }

    /**
     * Add donation amount to project
     */
    public function addDonation($amount)
    {
        $this->increment('raised_amount', $amount);
    }

    /**
     * Calculate progress percentage
     */
    public function getProgressPercentage()
    {
        if ($this->target_amount == 0) {
            return 0;
        }
        
        return ($this->raised_amount / $this->target_amount) * 100;
    }
}