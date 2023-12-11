<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_path'];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pets_id');
    }

}
