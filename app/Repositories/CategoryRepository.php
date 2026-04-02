<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function query(): Builder
    {
        return Category::query();
    }

    public function getRootCategories(): Collection
    {
        return Category::whereNull('parent_id')->get();
    }

    public function getRootCategoriesExcept(int $categoryId): Collection
    {
        return Category::whereNull('parent_id')
            ->where('id', '!=', $categoryId)
            ->get();
    }

    public function findByIdOrFail(int|string $id): Category
    {
        return Category::findOrFail($id);
    }

    public function findBySlugOrFail(string $slug): Category
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data): bool
    {
        return $category->update($data);
    }

    public function delete(Category $category): ?bool
    {
        return $category->delete();
    }

    public function onlyTrashed(): Collection
    {
        return Category::onlyTrashed()->get();
    }

    public function findTrashedByIdOrFail(int|string $id): Category
    {
        return Category::onlyTrashed()->where('id', $id)->firstOrFail();
    }

    public function restore(Category $category): ?bool
    {
        return $category->restore();
    }

    public function forceDelete(Category $category): ?bool
    {
        return $category->forceDelete();
    }
}
