<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Services\GuestUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('site.pages.wishlist', compact('wishlistItems'));
    }

    public function addItem(Request $request, GuestUserService $guestUserService)
    {
        $user = $guestUserService->findOrCreateGuestUser();
        $productId = $request->input('product_id');
        $userId = $user->id;

        if (!Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists()) {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            return back()->with('success', 'Product added to wishlist!');
        }

        return back()->with('info', 'Product already in wishlist.');
    }

    public function removeItem($id)
    {
        Wishlist::destroy($id);
        return back()->with('success', 'Product removed from wishlist.');
    }
}
