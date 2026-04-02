<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminOrderStatusUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in([
                'pending',
                'paid',
                'processing',
                'shipped',
                'delivered',
                'canceled',
                'refunded',
                'failed',
            ])],
        ];
    }
}
