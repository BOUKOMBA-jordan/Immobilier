<?php

namespace App\Models;

//use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', // Ensure this is included
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold',
        'image',
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Add any casts here if needed
    ];

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function getSlug(): string
    {
        return Str::slug($this->title);
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * Attach uploaded files to the property.
     *
     * @param UploadedFile[] $files
     * @return void
     */
    public function attachFiles(array $files): void
    {
        $pictures = [];
        foreach ($files as $file) {
            if ($file->getError()) {
                continue;
            }
            $filename = $file->store('properties/' . $this->id, 'public');
            $pictures[] = ['filename' => $filename];
        }
        if (count($pictures) > 0) {
            $this->pictures()->createMany($pictures);
        }
    }

    /**
     * Get the first picture of the property.
     *
     * @return Picture|null
     */
    public function getPicture(): ?Picture
    {
        return $this->pictures->first();
    }

    /**
     * Scope a query to only include available properties.
     *
     * @param Builder $builder
     * @param bool $available
     * @return Builder
     */
    public function scopeAvailable(Builder $builder, bool $available = true): Builder
    {
        return $builder->where('sold', !$available);
    }

    /**
     * Scope a query to only include recent properties.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeRecent(Builder $builder): Builder
    {
        return $builder->orderBy('created_at', 'desc');
    }
}