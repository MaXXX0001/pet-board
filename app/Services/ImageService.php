<?php

namespace App\Services;

use App\Interfaces\HasImage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageService
{
    /**
     * @param UploadedFile $image
     * @param $model
     * @return string[] Array of image paths
     */
    public function attachFile(UploadedFile $image, $model): array
    {
        $manager = new ImageManager(new Driver());

        $sizes = $model->imageSizes;
        $storagePath = $model->storagePath;

        $imagePaths = [];


        foreach ($sizes as $size) {
            list($width, $height, $sizeName) = $size;

            // Resizing image to each size
            $imageResize = $manager->read($image)
                ->resize($width, $height)
                ->encode();

            // Saving images
            $path = $storagePath . '/' . $sizeName . '/' . $image->hashName();
            $imageResize->save(public_path($path));

            // Collect data for later use
            $imagePaths[$sizeName] = $path;
        }

        // Return array of image paths
        return $imagePaths;
    }

    /**
     * Update images in model
     *
     * @param HasImage $model
     * @param UploadedFile $image
     * @return void
     */
    public function updateImage(HasImage $model, UploadedFile $image): void
    {
        $imagePaths = $this->attachFile($image, $model);

        foreach ($imagePaths as $size => $path) {
            $model->images()->updateOrCreate(
                ['size' => $size],
                ['path' => $path]
            );
        }
    }
}
