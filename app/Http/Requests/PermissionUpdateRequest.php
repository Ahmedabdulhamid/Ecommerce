<?php

namespace App\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.*' => [
                'required',
                'string',
                UniqueTranslationRule::for('permissions')->ignore($this->route('permission') ?? $this->input('permission')),
            ],
        ];
    }
}
