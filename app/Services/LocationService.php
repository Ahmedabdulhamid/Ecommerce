<?php

namespace App\Services;

use App\Repositories\LocationRepository;
use Illuminate\Support\Collection;

class LocationService
{
    public function __construct(private readonly LocationRepository $locations)
    {
    }

    public function getAllCountries(): Collection
    {
        return $this->locations->getAllCountries();
    }

    public function getActiveCountries(): Collection
    {
        return $this->locations->getActiveCountries();
    }

    public function getGovernoratesByCountryId(?int $countryId): Collection
    {
        return $this->locations->getGovernoratesByCountryId($countryId);
    }
}
