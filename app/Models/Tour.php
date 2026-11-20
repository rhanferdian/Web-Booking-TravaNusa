<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Tour extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tours';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'location',
        'price',
        'duration',
        'thumbnail',
        'description',
        'is_popular',
        'is_published',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_popular' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Formatted price attribute in IDR currency.
     */
    public function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn (): string => 'Rp ' . number_format($this->price, 0, ',', '.')
        );
    }

    /**
     * Resolves the full URL of the thumbnail.
     */
    public function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if (empty($this->thumbnail)) {
                    return 'https://placehold.co/600x400?text=No+Image';
                }

                if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                    return $this->thumbnail;
                }

                return asset('storage/' . ltrim($this->thumbnail, '/'));
            }
        );
    }

    /**
     * Get the bookings for this tour.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Booking>
     */
    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class, 'tour_id');
    }
}
