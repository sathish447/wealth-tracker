<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'account_type' => 'required|in:savings,current,cash,wallet,credit_card',

            'institution_name' => 'nullable|string|max:255',

            'account_number' => 'nullable|string|max:100',

            'opening_balance' => 'required|numeric|min:0',

            'notes' => 'nullable|string',
        ];
    }
}
