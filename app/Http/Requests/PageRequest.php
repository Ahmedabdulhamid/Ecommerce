<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'array',
                // هنا مربوطة مع عنوان الصفحة
            ],
            'title.*' => ['required', 'string',UniqueTranslationRule::for('pages')],

            'content' => ['required', 'array'],
            'content.*' => ['required', 'string'],

            'image' => ['nullable', 'image', 'mimes:png,jpg,svg,webp,jpeg'],

        ];
    }
    public function attributes()
    {
        return [
            'title.en' => __('sliders.titel_en'),
            'title.ar' => __('sliders.titel_ar'),
            'content.en' => __('sliders.content_en'),
            'content.ar' => __('sliders.contect_ar'),
            "image" => __('sliders.Images')
        ];
    }
}
