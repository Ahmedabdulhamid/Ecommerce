<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
           'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'countryId' => 'required|exists:countaries,id',

            'governorateId' => 'required|exists:governorates,id',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'notice' => 'nullable|string|max:1000',
            'paymentMethodId'=>['required']
        ];
    }
}
