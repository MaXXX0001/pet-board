<?php

namespace App\Services;

use App\Http\Requests\PetFilterRequest;
use App\Traits\Filters;

class PetFilterService
{
    use Filters;

    /**
     * Applies filters to a given query based on the provided request.
     *
     * @param PetFilterRequest $request The request containing the filter parameters.
     * @param mixed $query The query to apply the filters to.
     * @return mixed The modified query after applying the filters.
     */
    public function applyFilters(PetFilterRequest $request, mixed $query): mixed
    {
        $nameFilter = $request->input('name');
        $breedFilter = $request->input('breed');

        if (!empty($nameFilter)) {
            $this->filterByName($query, $nameFilter);
        }

        if (!empty($breedFilter)) {
            $this->filterByBreed($query, $breedFilter);
        }

        return $query;
    }
}
