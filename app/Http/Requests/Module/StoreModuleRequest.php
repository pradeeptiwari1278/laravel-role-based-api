<?php

namespace App\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class StoreModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->roles->contains('name', 'admin');
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|unique:modules,name|min:3',
        ];

        if ($this->route('module')) {
            $rules['name'] = 'required|string|min:3|unique:modules,name,' . $this->route('module')->id;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Module name is required.',
            'name.unique' => 'This module already exists.',
        ];
    }
}
