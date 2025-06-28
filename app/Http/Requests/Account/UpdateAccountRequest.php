<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only allow if user has update permission on account
        return auth()->user()->hasPermission('account', 'update');
    }

    public function rules(): array
    {
        return [
            'account_name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'account_name.required' => 'Account name is required.',
            'balance.required' => 'Balance is required.',
        ];
    }
}

