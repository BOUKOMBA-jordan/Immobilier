<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $table = 'property_images'; // Nom de la table, à adapter si nécessaire

    protected $fillable = [
        'property_id',
        'vehicle_id',
        'image',
    ];

    /**
     * Get the property that owns the picture.
     */
    public function property()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the vehicle that owns the picture.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}