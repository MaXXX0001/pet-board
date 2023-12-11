<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'breed', 'status', 'image_path', 'author_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'pets_id');
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
