<?php

namespace App\Http\Requests;

use Flasher\Laravel\Facade\Flasher;
use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;


class UpdateCategoryRequest extends FormRequest
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

            ],
            'name.ar' => [
                'required',
                'string',

            ],

            'parent_id' => "required|integer"


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
