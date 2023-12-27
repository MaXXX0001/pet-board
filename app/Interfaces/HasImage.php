<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasImage
{
    /**
     * Get the images associated with the model.
     *
     * @return HasMany
     */
    public function images(): HasMany;
}
