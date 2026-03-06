<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'description', 'country', 'rooms', 'price_per_night'];
    public $timestamps = false;

    public function scopeOwnedByUser($query, $userId)
    {
        return $query->where('user_id', $userId);

    }
    public function scopeBookedByUser($query, $userId)
    {
        return $query->whereHas('bookings', fn ($q) => $q->where('user_id', $userId));
    }

    public function getImageUrlAttribute()
    {
        if ($this->images->count() > 0) {
            return asset('storage/' . $this->images->first()->image_path);
        }
        return 'https://via.placeholder.com/800x400?text=No+Image';
    }
    public function isCurrentlyBooked(): bool
    {
        return $this->bookings()
            ->where('end_date', '>=', now())
            ->exists();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function activeBookingForUser(): ?Booking
    {
        return $this->bookings()
            ->where('user_id', auth()->id())
            ->where('end_date', '>=', now())
            ->first();
    }
}
