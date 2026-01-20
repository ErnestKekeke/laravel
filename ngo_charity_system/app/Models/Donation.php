<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_id',
        'amount',
        'project_name',
        'payment_method',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    /**
     * Get the donor that made this donation
     */
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    /**
     * Create a new donation
     */
    public static function createDonation($donorId, $projectName, $amount, $paymentMethod)
    {
        return self::create([
            'donor_id' => $donorId,
            'amount' => $amount,
            'project_name' => $projectName,
            'payment_method' => $paymentMethod,
            'status' => 'completed' // Simulated for development
        ]);
    }

    /**
     * Get recent donations with donor info
     */
    public static function getRecentWithDonor($limit = 10)
    {
        return self::join('donors', 'donations.donor_id', '=', 'donors.id')
            ->select('donations.*', 'donors.name as donor_name')
            ->orderBy('donations.created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get total donations amount
     */
    public static function getTotalAmount()
    {
        return self::where('status', 'completed')->sum('amount');
    }
}