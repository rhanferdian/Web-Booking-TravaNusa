<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tour_id',
        'booking_code',
        'customer_name',
        'customer_phone',
        'travel_date',
        'total_pax',
        'total_amount',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'travel_date' => 'date',
            'total_pax' => 'integer',
            'total_amount' => 'integer',
        ];
    }

    /**
     * Formatted total amount attribute in IDR currency.
     */
    public function formattedTotalAmount(): Attribute
    {
        return Attribute::make(
            get: fn (): string => 'Rp ' . number_format($this->total_amount, 0, ',', '.')
        );
    }

    /**
     * Get the tour that this booking belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Tour>
     */
    public function tour(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
