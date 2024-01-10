<?php

namespace App\Traits;

trait Filters
{
    public function filterByName($query, $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

    public function filterByBreed($query, $breed)
    {
        return $query->where('breed', 'like', "%$breed%");
    }
}
