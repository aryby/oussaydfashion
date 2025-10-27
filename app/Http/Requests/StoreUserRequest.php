<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'string|max:25|regex:/^[a-z ,.\'-]+$/i',
            'last_name' => 'string|max:25|regex:/^[a-z ,.\'-]+$/i',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => ['required', Password::defaults()],
            'address' => 'nullable|string|max:255',
            'phone_number' => 'string|max:20',
        ];
    }
}
