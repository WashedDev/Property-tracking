<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PropertyHistory extends Model
{
    protected $fillable = ['property_id', 'performed_by', 'action', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}