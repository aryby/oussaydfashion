<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CheckoutSuccessController;
use App\Http\Controllers\CheckoutResponseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageSwitcherController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('lang/{locale}', LanguageSwitcherController::class)->name('langswitcher');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/orders/{order}/invoice', InvoiceController::class)
    ->name('order.invoice');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('products.categories');

// Categories
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])
    ->name('categories.show');

// Products
Route::get('/products/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/search', [ProductController::class, 'search'])
    ->name('products.search');


Route::get('/products/prices-drop', [ProductController::class, 'pricesDrop'])->name('products.prices_drop');
Route::get('/products/new', [ProductController::class, 'new'])->name('products.new');
Route::get('/products/best-sales', [ProductController::class, 'bestSales'])->name('products.bestsales');

Route::get('/contact', [PageController::class, 'contact'])->name('contact.index');
Route::get('/sitemap', [PageController::class, 'sitemap'])->name('sitemap.index');

Route::get('/delivery-info', [PageController::class, 'deliveryInfo'])->name('delivery.info');
Route::get('/legal-notice', [PageController::class, 'legalNotice'])->name('legal.notice');
Route::get('/terms-conditions', [PageController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about.us');
Route::get('/secure-payment', [PageController::class, 'securePayment'])->name('secure.payment');

Route::get('/services/returns', [PageController::class, 'returns'])->name('services.returns');
Route::get('/services/faq', [PageController::class, 'faq'])->name('services.faq');
Route::get('/services/shipping', [PageController::class, 'shipping'])->name('services.shipping');
Route::get('/services/warranty', [PageController::class, 'warranty'])->name('services.warranty');
Route::get('/services/gift-cards', [PageController::class, 'giftCards'])->name('services.gift_cards');

Route::get('/cart', [CartController::class, 'get'])
    ->name('cart.index');

Route::post('/cart/add', [CartController::class, 'addItem'])
    ->name('cart.addItem');

Route::middleware('auth')->group(function () {
    Route::get('/account', [ProfileController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('account.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('account.destroy');

    Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])
        ->name('cart.removeItem');

    Route::get('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist.index');

    Route::post('/wishlist/add', [WishlistController::class, 'addItem'])
        ->name('wishlist.addItem');

    Route::get('/wishlist/item/{id}/remove', [WishlistController::class, 'removeItem'])
        ->name('wishlist.removeItem');

    // Account orders
    Route::get('account/orders', [AccountController::class, 'getOrders'])
        ->name('account.orders');

    // Checkout
    Route::middleware('cartNotEmpty')->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'get'])
            ->name('checkout.index');

        Route::post('/checkout/paypalorder', [CheckoutController::class, 'placePayPalOrder'])
            ->name('checkout.placePayPalOrder');

        Route::post('/checkout/paymoborder', [CheckoutController::class, 'placePayMobOrder'])
            ->name('checkout.placePayMobOrder');
        Route::post('/checkout/paycashorder', [CheckoutController::class, 'placePayCashOrder'])
            ->name('checkout.placePayCashOrder');
        // PayPal
        Route::get('handle-payment', [PayPalPaymentController::class, 'handlePayment'])
            ->name('payment.make');

        Route::get('cancel-payment', [PayPalPaymentController::class, 'cancelPayment'])
            ->name('payment.cancel');

        Route::get('success-payment', [PayPalPaymentController::class, 'successPayment'])
            ->name('payment.success');

        Route::get('/checkout/success/{order}', CheckoutSuccessController::class)
            ->name('checkout.success');
    });
});

Route::get('checkout/response', CheckoutResponseController::class);


require __DIR__ . '/auth.php';
