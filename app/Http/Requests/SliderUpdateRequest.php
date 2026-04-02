<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'note' => ['required', 'array'],
            'note.en' => ['required', 'string'],
            'note.ar' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,svg,jpeg,webp'],
        ];
    }
}
