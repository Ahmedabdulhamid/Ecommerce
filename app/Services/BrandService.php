<?php

namespace App\Services;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public function __construct(private readonly BrandRepository $brands)
    {
    }

    public function query(): Builder
    {
        return $this->brands->query();
    }

    public function create(array $data, UploadedFile $logo): Brand
    {
        $data['logo'] = $this->storeLogo($logo);

        return $this->brands->create($data);
    }

    public function findBySlug(string $slug): Brand
    {
        return $this->brands->findBySlugOrFail($slug);
    }

    public function updateBySlug(string $slug, array $data, ?UploadedFile $logo = null): bool
    {
        $brand = $this->brands->findBySlugOrFail($slug);

        if ($logo !== null) {
            $this->deleteLogo($brand->logo);
            $data['logo'] = $this->storeLogo($logo);
        }

        return $this->brands->update($brand, $data);
    }

    public function toggleStatus(int|string $id): void
    {
        $brand = $this->brands->findByIdOrFail($id);

        $this->brands->update($brand, [
            'status' => $brand->status === 'active' ? 'inactive' : 'active',
        ]);
    }

    public function deleteById(int|string $id): void
    {
        $brand = $this->brands->findByIdOrFail($id);
        $this->brands->delete($brand);
    }

    public function getRecycleBin(): Collection
    {
        return $this->brands->onlyTrashed();
    }

    public function restoreById(int|string $id): void
    {
        $brand = $this->brands->findTrashedByIdOrFail($id);
        $this->brands->restore($brand);
    }

    public function forceDeleteTrashedById(int|string $id): void
    {
        $brand = $this->brands->findTrashedByIdOrFail($id);
        $this->deleteLogo($brand->logo);
        $this->brands->forceDelete($brand);
    }

    public function forceDeleteById(int|string $id): void
    {
        $brand = $this->brands->findByIdOrFail($id);
        $this->deleteLogo($brand->logo);
        $this->brands->forceDelete($brand);
    }

    private function storeLogo(UploadedFile $logo): string
    {
        $fileName = time() . '-' . $logo->getClientOriginalName();
        $logo->storeAs('logo', $fileName, 'public');

        return $fileName;
    }

    private function deleteLogo(?string $logo): void
    {
        if ($logo && Storage::exists('public/logo/' . $logo)) {
            Storage::delete('public/logo/' . $logo);
        }
    }
}
