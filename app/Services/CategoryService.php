<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(private readonly CategoryRepository $categories)
    {
    }

    public function query(): Builder
    {
        return $this->categories->query();
    }

    public function getRootCategories(): Collection
    {
        return $this->categories->getRootCategories();
    }

    public function findBySlug(string $slug): Category
    {
        return $this->categories->findBySlugOrFail($slug);
    }

    public function getEditableParents(Category $category): Collection
    {
        return $this->categories->getRootCategoriesExcept($category->id);
    }

    public function toggleStatus(int|string $id): void
    {
        $category = $this->categories->findByIdOrFail($id);

        $this->categories->update($category, [
            'status' => $category->status === 'active' ? 'inactive' : 'active',
        ]);
    }

    public function create(array $data): Category
    {
        return $this->categories->create($data);
    }

    public function updateBySlug(string $slug, array $data): bool
    {
        $category = $this->categories->findBySlugOrFail($slug);

        return $this->categories->update($category, $data);
    }

    public function deleteById(int|string $id): void
    {
        $category = $this->categories->findByIdOrFail($id);
        $this->categories->delete($category);
    }

    public function getRecycleBin(): Collection
    {
        return $this->categories->onlyTrashed();
    }

    public function restoreById(int|string $id): void
    {
        $category = $this->categories->findTrashedByIdOrFail($id);
        $this->categories->restore($category);
    }

    public function forceDeleteTrashedById(int|string $id): void
    {
        $category = $this->categories->findTrashedByIdOrFail($id);
        $this->categories->forceDelete($category);
    }

    public function forceDeleteById(int|string $id): void
    {
        $category = $this->categories->findByIdOrFail($id);
        $this->categories->forceDelete($category);
    }
}
