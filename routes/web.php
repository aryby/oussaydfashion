<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageSwitcherController;
use App\Http\Controllers\PayPalPaymentController;
use Illuminate\Support\Facades\Session;

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

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::get('lang/{locale}', LanguageSwitcherController::class)->name('langswitcher');


Route::view('/', 'site.pages.home')->name('home');

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


Route::get('/products/prices-drop', function () { return view('site.pages.products.prices_drop'); })->name('products.prices_drop');
Route::get('/products/new', function () { return view('site.pages.products.new'); })->name('products.new');
Route::get('/products/best-sales', function () { return view('site.pages.products.bestsales'); })->name('products.bestsales');
Route::get('/contact', function () { return view('site.pages.contact.index'); })->name('contact.index');
Route::get('/sitemap', function () { return view('site.pages.sitemap.index'); })->name('sitemap.index');

Route::get('/delivery-info', function () { return view('site.pages.company.delivery_info'); })->name('delivery.info');
Route::get('/legal-notice', function () { return view('site.pages.company.legal_notice'); })->name('legal.notice');
Route::get('/terms-conditions', function () { return view('site.pages.company.terms_conditions'); })->name('terms.conditions');
Route::get('/about-us', function () { return view('site.pages.company.about_us'); })->name('about.us');
Route::get('/secure-payment', function () { return view('site.pages.company.secure_payment'); })->name('secure.payment');

Route::get('/services/returns', function () { return view('site.pages.services.returns'); })->name('services.returns');
Route::get('/services/faq', function () { return view('site.pages.services.faq'); })->name('services.faq');
Route::get('/services/shipping', function () { return view('site.pages.services.shipping'); })->name('services.shipping');
Route::get('/services/warranty', function () { return view('site.pages.services.warranty'); })->name('services.warranty');
Route::get('/services/gift-cards', function () { return view('site.pages.services.gift_cards'); })->name('services.gift_cards');

Route::middleware('auth')->group(function () {
    Route::get('/account', [ProfileController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('account.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('account.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'get'])
        ->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'addItem'])
        ->name('cart.addItem');

    Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])
        ->name('cart.removeItem');

    Route::get('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');

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

        Route::get('/checkout/success/{order}', function (\App\Models\Order $order) {
            \Cart::session(auth()->id())->clear();
            return to_route('account.orders')->with('success', 'Order #' . $order->order_number . ' has been placed successfully!');
        })->name('checkout.success');
    });
});

Route::get('checkout/response', function () {
    \Cart::session(auth()->id())->clear();
    return to_route('account.orders');
});


require __DIR__ . '/auth.php';
