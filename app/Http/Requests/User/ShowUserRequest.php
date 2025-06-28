<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $auth = auth()->user();
        $user = $this->route('user'); // Gets the user model from the route

        // Allow if: Admin or the user is accessing their own profile
        return $auth->hasRole('admin') || $auth->id === $user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function forbiddenResponse()
    {
        return response()->json([
            'message' => 'Forbidden. You are not authorized to view this profile.'
        ], 403);
    }
}
