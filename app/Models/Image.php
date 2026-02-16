<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = ['image_path', 'apartment_id'];
    public $timestamps = false;


    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
