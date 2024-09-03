<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the vehicles associated with this option.
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'option_vehicle');
    }
    
}