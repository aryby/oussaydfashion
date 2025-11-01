<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserService
{
    /**
     * Update guest user with real information from order
     */
    public function updateGuestUserWithOrderInfo(array $orderData): User
    {
        $user = Auth::user();

        if (!$user || !str_starts_with($user->email, 'guest_')) {
            return $user;
        }

        $user->first_name = $orderData['first_name'] ?? $user->first_name;
        $user->last_name = $orderData['last_name'] ?? $user->last_name;
        $user->email = $orderData['email'] ?? $user->email;
        
        // Only set password if email is being updated (user converting from guest to real account)
        if (isset($orderData['email']) && $orderData['email'] !== $user->email) {
            $user->password = bcrypt(Str::random(10));
        }

        $user->save();
        Auth::login($user); // Re-login to refresh session data

        return $user;
    }
}
