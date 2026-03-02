<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    protected $fillable = [
        'name',
        'model',
        'quantity',
        'serial_number',
        'type',
        'license_plate',
        'user_id',
        'status'
    ];
}
