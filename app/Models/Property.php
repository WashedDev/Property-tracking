<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    // Make sure your fillable array includes the new fields we added earlier
    protected $fillable = [
        'name',
        'model',
        'quantity',
        'type',
        'serial_number',
        'license_plate',
        'user_id',
        'status',
        'procurement_date',
        'warranty_expiration',
        'estimated_value'
    ];

    /**
     * FIX: Tell the Property that it belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tell the Property that it has many Audit History Logs
     */
    public function histories()
    {
        return $this->hasMany(PropertyHistory::class)->latest();
    }
}