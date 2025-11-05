<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'city' => 'nullable|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'state' => 'nullable|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'country' => 'nullable|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'phone_number' => ['nullable', 'string'],
            'password' => ['nullable', \Illuminate\Validation\Rules\Password::defaults()],
        ];
    }
}
