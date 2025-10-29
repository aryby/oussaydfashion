<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories', 'offer', 'ratings'])->get();
        return view('site.pages.home', compact('products'));
    }
}
