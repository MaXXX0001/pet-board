<?php

namespace App\Models;

use App\Interfaces\HasImage;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Intervention\Image\EncodedImage;

class Pet extends Model implements HasImage
{
    protected $fillable = ['name', 'description', 'breed', 'status', 'author_id'];

    /**
     * Get the user associated with the model.
     *
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the comments associated with the pets.
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'pets_id');
    }

    /**
     * Checks if the object is approved.
     *
     * @return bool Returns true if the object is approved, false otherwise.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @param UploadedFile $image
     * @return EncodedImage
     */
    public function attachFile(UploadedFile $image): EncodedImage
    {
        $imageService = app(ImageService::class);
        return $imageService->attachFile($image, $this);
    }

    /**
     * Updates the image of the given model with the provided uploaded file.
     *
     * @param UploadedFile|null $image The image file to update.
     * @return void
     */
    public function updateImage(?UploadedFile $image): void
    {
        if ($image) {
            $imageService = app(ImageService::class);
            $imageService->updateImage($this, $image);
        }
    }

    /**
     * The path to the storage directory for images.
     *
     * @var string $storagePath
     */
    public string $storagePath = 'storage/images';

    public array $imageSizes = [
        [350, 200, '350x200'],
        [1200, 630, '1200x630']
    ];

    /**
     * Get the images associated with the model.
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(PetImage::class, 'pet_id');
    }
}
