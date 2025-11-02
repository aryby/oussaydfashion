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

        // Si aucun utilisateur n'est connecté, créer un guest
        if (!$user) {
            $guestEmail = 'guest_' . (isset($orderData['phone_number']) ? preg_replace('/\D/', '', $orderData['phone_number']) : uniqid()) . '@guest.local';
            $user = User::where('email', $guestEmail)->first();
            if (!$user) {
                $user = User::create([
                    'first_name' => $orderData['first_name'] ?? 'Guest',
                    'last_name' => $orderData['last_name'] ?? '',
                    'email' => $guestEmail,
                    'password' => bcrypt(Str::random(10)),
                ]);
            }
            Auth::login($user);
        }

        // Mettre à jour les infos du guest si besoin
        if (str_starts_with($user->email, 'guest_')) {
            $user->first_name = $orderData['first_name'] ?? $user->first_name;
            $user->last_name = $orderData['last_name'] ?? $user->last_name;
            $user->email = $orderData['email'] ?? $user->email;
            // Only set password if email is being updated (user converting from guest to real account)
            if (isset($orderData['email']) && $orderData['email'] !== $user->email) {
                $user->password = bcrypt(Str::random(10));
            }
            $user->save();
            Auth::login($user); // Re-login to refresh session data
        }

        return $user;
    }
}
