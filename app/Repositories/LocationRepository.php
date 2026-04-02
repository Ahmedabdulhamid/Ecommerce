<?php

namespace App\Repositories;

use App\Models\Countary;
use App\Models\Governorate;
use Illuminate\Support\Collection;

class LocationRepository
{
    public function getAllCountries(): Collection
    {
        return Countary::all();
    }

    public function getActiveCountries(): Collection
    {
        return Countary::whereStatus('active')->get();
    }

    public function findCountryById(?int $countryId): ?Countary
    {
        if (!$countryId) {
            return null;
        }

        return Countary::find($countryId);
    }

    public function getGovernoratesByCountryId(?int $countryId): Collection
    {
        if (!$countryId) {
            return collect();
        }

        return Governorate::where('countary_id', $countryId)->get();
    }
}
