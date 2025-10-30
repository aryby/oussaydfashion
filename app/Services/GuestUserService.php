<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GuestUserService
{
    public function findOrCreateGuestUser()
    {
        if (Auth::check()) {
            return Auth::user();
        }

        // Check if a guest user token exists in the session or local storage (if implemented)
        // For now, we'll just create a new one if not authenticated.
        $guestUser = User::create([
            'first_name' => 'Guest',
            'last_name' => 'User',
            'email' => 'guest_' . Str::random(10) . '@example.com',
            'password' => bcrypt(Str::random(10)),
        ]);

        Auth::login($guestUser);

        return $guestUser;
    }
}