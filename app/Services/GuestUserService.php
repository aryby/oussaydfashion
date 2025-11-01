<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class GuestUserService
{
    private const GUEST_USER_COOKIE_NAME = 'guest_user_id';
    private const GUEST_USER_COOKIE_LIFETIME = 60 * 24 * 30; // 30 days

    public function findOrCreateGuestUser()
    {
        if (Auth::check()) {
            return Auth::user();
        }

        // Check if a guest user ID exists in cookies
        $guestUserId = request()->cookie(self::GUEST_USER_COOKIE_NAME);

        if ($guestUserId) {
            $guestUser = User::find($guestUserId);
            
            if ($guestUser && str_starts_with($guestUser->email, 'guest_')) {
                Auth::login($guestUser);
                return $guestUser;
            }
        }

        // Check if a guest user ID exists in session storage
        $sessionGuestId = session('guest_user_id');
        if ($sessionGuestId) {
            $guestUser = User::find($sessionGuestId);
            
            if ($guestUser && str_starts_with($guestUser->email, 'guest_')) {
                Auth::login($guestUser);
                $this->storeGuestUserId($guestUser->id);
                return $guestUser;
            }
        }

        // Create a new guest user if none exists
        $guestUser = User::create([
            'first_name' => 'Guest',
            'last_name' => 'User',
            'email' => 'guest_' . Str::random(10) . '@example.com',
            'password' => bcrypt(Str::random(10)),
        ]);

        Auth::login($guestUser);
        $this->storeGuestUserId($guestUser->id);

        return $guestUser;
    }

    /**
     * Store guest user ID in cookies and session
     */
    private function storeGuestUserId(int $userId): void
    {
        session(['guest_user_id' => $userId]);
        Cookie::queue(
            Cookie::make(self::GUEST_USER_COOKIE_NAME, $userId, self::GUEST_USER_COOKIE_LIFETIME)
        );
    }
}