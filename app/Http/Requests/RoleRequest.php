<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class RoleRequest extends FormRequest
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
        'role' => 'required|array',
        'role.ar' => [
            'required',
            'string',
            'max:255',

        ],
        'role.en' => [
            'required',
            'string',
            'max:255',

        ],


        'permissions' => 'required|array|min:1',
          UniqueTranslationRule::for('roles')
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
