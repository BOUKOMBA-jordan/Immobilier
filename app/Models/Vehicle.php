<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'make', // Marque
        'model', // Modèle
        'year', // Année de fabrication
        'price', // Prix
        'mileage', // Kilométrage
        'color', // Couleur
        'description', // Description
        'image', // Image principale
        'is_available', // Disponibilité
    ];

    protected $casts = [
        'year' => 'integer',
        'price' => 'decimal:2',
        'mileage' => 'integer',
        'is_available' => 'boolean',
    ];

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    public function options()
{
    return $this->belongsToMany(Option::class, 'option_vehicle');
}


    public function attachFiles(array $files): void
    {
        $pictures = [];
        foreach ($files as $file) {
            if ($file->getError()) {
                continue;
            }
            $filename = $file->store('vehicles/' . $this->id, 'public');
            $pictures[] = ['filename' => $filename];
        }
        if (count($pictures) > 0) {
            $this->pictures()->createMany($pictures);
        }
    }

    public function getPicture(): ?Picture
    {
        return $this->pictures->first();
    }

    public function scopeRecent(Builder $builder): Builder
    {
        return $builder->orderBy('created_at', 'desc');
    }

    public function scopePriceRange(Builder $builder, int $minPrice, int $maxPrice): Builder
    {
        return $builder->whereBetween('price', [$minPrice, $maxPrice]);
    }

    public function scopeByYear(Builder $builder, int $year): Builder
    {
        return $builder->where('year', $year);
    }

    public function scopeAvailable(Builder $builder): Builder
    {
        return $builder->where('is_available', true);
    }
}