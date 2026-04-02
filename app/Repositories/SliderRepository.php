<?php

namespace App\Repositories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder;

class SliderRepository
{
    public function query(): Builder
    {
        return Slider::query();
    }

    public function create(array $data): Slider
    {
        return Slider::create($data);
    }

    public function findByIdOrFail(int|string $id): Slider
    {
        return Slider::findOrFail($id);
    }

    public function update(Slider $slider, array $data): bool
    {
        return $slider->update($data);
    }

    public function delete(Slider $slider): ?bool
    {
        return $slider->delete();
    }
}
