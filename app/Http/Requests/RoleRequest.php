<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
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
        'role.en' => [
            'required',
            'string',
            'max:255',
            function ($attribute, $value, $fail) {
                // Check if the English name already exists in the database
                if (Role::where('name->en', $value)->exists()) {
                    $fail('The role name with English already exists.');
                }
            },
        ],
        'role.ar' => [
            'required',
            'string',
            'max:255',
            function ($attribute, $value, $fail) {
                // Check if the Arabic name already exists in the database
                if (Role::where('name->ar', $value)->exists()) {
                    $fail('The role name with Arabic already exists.');
                }
            },
        ],
        'permissions' => 'required|array|min:1',
    ];

}
protected function failedValidation(Validator $validator)
{
    foreach ($validator->errors()->all() as $error) {
        Flasher::addError($error);
    }

    throw new ValidationException($validator);
}
public function attributes(){
 return [
    'role.en'=>__('validation.role.en'),
    'role.ar'=>__('validation.role.ar'),
    'permissions'=>__('validation.attributes.permissions')
 ];
}
}
