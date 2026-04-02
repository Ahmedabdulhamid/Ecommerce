<?php

namespace App\Services;

use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function __construct(private readonly SliderRepository $sliders)
    {
    }

    public function query(): Builder
    {
        return $this->sliders->query();
    }

    public function create(array $data, UploadedFile $image): Slider
    {
        $data['file_name'] = $this->storeImage($image);

        return $this->sliders->create($data);
    }

    public function update(int|string $id, array $data, ?UploadedFile $image = null): bool
    {
        $slider = $this->sliders->findByIdOrFail($id);

        if ($image !== null) {
            $this->deleteImage($slider->file_name);
            $data['file_name'] = $this->storeImage($image);
        }

        return $this->sliders->update($slider, $data);
    }

    public function delete(int|string $id): void
    {
        $slider = $this->sliders->findByIdOrFail($id);
        $this->deleteImage($slider->file_name);
        $this->sliders->delete($slider);
    }

    private function storeImage(UploadedFile $image): string
    {
        $fileName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('slider', $fileName, 'public');

        return $fileName;
    }

    private function deleteImage(?string $fileName): void
    {
        if ($fileName && Storage::exists('public/slider/' . $fileName)) {
            Storage::delete('public/slider/' . $fileName);
        }
    }
}
