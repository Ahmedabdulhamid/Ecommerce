<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BrandRepository
{
    public function query(): Builder
    {
        return Brand::query();
    }

    public function findByIdOrFail(int|string $id): Brand
    {
        return Brand::findOrFail($id);
    }

    public function findBySlugOrFail(string $slug): Brand
    {
        return Brand::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(Brand $brand, array $data): bool
    {
        return $brand->update($data);
    }

    public function delete(Brand $brand): ?bool
    {
        return $brand->delete();
    }

    public function onlyTrashed(): Collection
    {
        return Brand::onlyTrashed()->get();
    }

    public function findTrashedByIdOrFail(int|string $id): Brand
    {
        return Brand::onlyTrashed()->where('id', $id)->firstOrFail();
    }

    public function restore(Brand $brand): ?bool
    {
        return $brand->restore();
    }

    public function forceDelete(Brand $brand): ?bool
    {
        return $brand->forceDelete();
    }
}
