<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $table = 'property_images';

    protected $fillable = [
        'property_id',
        'image',
    ];

    /**
     * Get the property that owns the picture.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}