<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
class BrandRequest extends FormRequest
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
            'name' => 'required|array',
            'name.en' => [
                'required',
                'string',
                function ($attributes, $value, $fail) {
                    if (Brand::where('name->en', $value)->exists()) {
                        $fail('Name with English Exists');
                    }
                }
            ],
            'name.ar' => [
                'required',
                'string',
                function ($attributes, $value, $fail) {
                    if (Brand::where('name->ar', $value)->exists()) {
                        $fail('Name with Arabic Exists');
                    }
                }
            ],
            'status' => 'required',
            'logo'=>"required|image"


        ];
    }
    protected function failedValidation(Validator $validator)
    {
        foreach ($validator->errors()->all() as $error) {
            Flasher::addError($error);
        }

        throw new ValidationException($validator);
    }
}
