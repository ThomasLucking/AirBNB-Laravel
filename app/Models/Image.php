<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image_path', 'apartment_id'];
    public $timestamps = false;


    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
