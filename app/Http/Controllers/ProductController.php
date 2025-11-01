<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $attributes = Attribute::select(['id', 'name', 'name_ar'])->get();

        $product->load(['attributes' => function ($query) {
            $query->orderBy('price', 'asc');
        }, 'brand', 'offer', 'ratings']);

        return view('site.pages.product', compact('product', 'attributes'));
    }

    public function search(Request $request)
    {
        if ($request->q == null) {
            return view('site.pages.searched_products', [
                'products' => Product::featured()->get(),
            ]);
        } else {
            return view('site.pages.searched_products', [
                'products' => Product::search('name', '%' . $request->q . '%')->get(),
                'q' => $request->q
            ]);
        }
    }

    public function pricesDrop()
    {
        $products = Product::whereNotNull('sale_price')
            ->with(['ratings', 'offer'])
            ->get();
        
        return view('site.pages.products.prices_drop', compact('products'));
    }

    public function new()
    {
        $products = Product::recentlyAdded()
            ->with(['ratings', 'offer'])
            ->get();
        
        return view('site.pages.products.new', compact('products'));
    }

    public function bestSales()
    {
        $products = Product::featured()
            ->with(['ratings', 'offer'])
            ->get();
        
        return view('site.pages.products.bestsales', compact('products'));
    }
}
