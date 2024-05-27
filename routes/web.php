<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CancelController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\RoomController;



Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dash', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin view route
// Route::view('/admin','admin');

//role wisw open 
use App\Http\Middleware\RoleBaseMiddleware;

Route::group(['prefix' => 'Publisher', 'middleware' => RoleBaseMiddleware::class . ':Publisher'], function() {
    Route::get('index', [ProductController::class, 'index'])->name('product.index');
    Route::get('order', [ProductController::class, 'order'])->name('product.order');

});



Route::any('/dash', [ProductController::class,'dash'])->middleware(['auth','verified'])->name('product.dash');
Route::get('/create', [ProductController::class,'create'])->middleware(['auth','verified'])->name('product.create');
Route::post('/product/store', [ProductController::class,'store'])->name('product.store');
Route::get('product/{id}/edit', [ProductController::class,'edit'])->name('product.edit');
Route::post('product_update/{id}', [ProductController::class,'update']);
Route::delete('product_delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

// Authentication routes
Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['verified']], function() {
        // User login
        Route::post('/login/User', [AuthenticatedSessionController::class, 'storeUser'])->name('login.user');
    });
});


// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//reset-password
Route::get('reset-password/{token}', [AuthenticatedSessionController::class, 'resetPasswordForm'])->name('password.reset.form');
Route::post('reset-password', [AuthenticatedSessionController::class, 'resetPassword'])->name('password.reset.action');


// Laravel authentication routes
Auth::routes(['verify' => true]);

// Home route
Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

//logout
Route::post('/logout', function () {
    auth()->logout(); // Logout the currently authenticated user
    return redirect('/'); // Redirect to the home page or any other desired location after logout
})->name('logout');

// In your web.php routes file
Route::get('/profile', [ProfileController::class, 'show'])->middleware(['auth','verified'])->name('profile.show');

//detail
Route::get('/add-to-cart/{id}', [HomeController::class, 'addToCart'])->middleware(['auth','verified'])->name('add_to_cart');
Route::get('/cart', [HomeController::class, 'cart'])->middleware(['auth','verified'])->name('cart');
Route::patch('/update-cart', [HomeController::class, 'update'])->middleware(['auth','verified'])->name('update_cart');
Route::delete('/remove-from-cart', [HomeController::class, 'remove'])->middleware(['auth','verified'])->name('remove_from_cart');

//checkout
// Route::get('/checkout', [HomeController::class,'checkout'])->name('checkout');
// Route::post('/checkout', [HomeController::class,'checkoutdetail'])->name('checkout.process');

//payment
Route::get('paypal', [PayPalController::class, 'index'])->name('paypal');
Route::get('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');

//purchase
Route::get('purchase', [PurchaseController::class, 'purchase'])->middleware(['auth','verified'])->name('purchase');
Route::get('yourorder', [PurchaseController::class, 'yourorder'])->middleware(['auth','verified'])->name('yourorder');

//cancel
Route::any('cancel/{purchase_id}', [CancelController::class,'cancel'])->middleware(['auth','verified'])->name('cancel');

Route::post('cancel-order/{purchase_id}', [CancelController::class,'cancelOrder'])->middleware(['auth','verified'])->name('cancelOrder');

Route::get('cancelview', [CancelController::class,'cancelview'])->middleware(['auth','verified'])->name('cancelview');

Route::post('purchaseapprove/{id}', [CancelController::class,'purchaseapprove'])->middleware(['auth','verified'])->name('purchase.approve');

Route::any('purchasecancel/{id}', [CancelController::class,'purchasecancel'])->middleware(['auth','verified'])->name('purchase.cancel');

Route::any('delete/{id}', [CancelController::class,'deletecancel'])->middleware(['auth','verified'])->name('deletecancel.cancel');

Route::get('products/search', [ProductController::class, 'search'])->middleware(['auth','verified'])->name('product.search');


Route::get('/parnk', function () {
    return view('parnk');
})->name('parnk');

Route::get('/mobile',[PurchaseController::class,'mobile'])->name('mobile');
Route::post('/store', [PurchaseController::class, 'store'])->name('store');
Route::delete('products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('product.bulkDelete');

//website
Route::get('website', [WebsiteController::class,'website'])->middleware(['auth','verified'])->name('website');
Route::get('website/{id}/edit', [WebsiteController::class,'editWebsite'])->name('website.edit');
Route::put('/websites/{id}', [WebsiteController::class, 'updateWebsite'])->name('website.update');
Route::delete('website_delete/{id}', [WebsiteController::class, 'deleteWebsite'])->name('website.delete');
Route::get('/website/create', [WebsiteController::class, 'createWebsite'])->name('createWebsite');
Route::post('/website/store', [WebsiteController::class, 'storeWebsite'])->name('storeWebsite');

//room
Route::get('/room', [RoomController::class, 'room'])->name('roombook');
Route::post('/book-slot/{slot}', [RoomController::class, 'bookSlot'])->name('book.slot');
Route::get('/adminroom', [RoomController::class, 'adminroom'])->name('adminroom');
Route::get('/roombook', [RoomController::class, 'roomorder'])->name('userroom');
Route::delete('/room/{roomId}/cancel', [RoomController::class,'cancelRoom'])->name('cancel.room');
Route::get('get-booked-slots/{date}', [RoomController::class, 'getBookedSlots'])->name('get.booked.slots');





// Route::group(['middleware' => ['auth']], function() {
//     Route::group(['middleware' => ['verified']], function() {
// Route::post('/login/User', [AuthenticatedSessionController::class, 'storeUser'])->name('login');
// });
// });
// Route::any('/login/dash', [AuthenticatedSessionController::class, 'storeAdmin'])->name('login');

// Admin login route
// Route::any('/login/dash', [AuthenticatedSessionController::class, 'storeAdmin'])->name('login.admin');

// Password reset routes
// Route::get('forgot-password', [AuthenticatedSessionController::class, 'forgotPasswordForm'])->name('password.request');
// Route::post('forgot-password', [AuthenticatedSessionController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('reset-password/{token}', [AuthenticatedSessionController::class, 'resetPasswordForm'])->name('password.reset.form');
// Route::post('reset-password', [AuthenticatedSessionController::class, 'resetPassword'])->name('password.reset.post');

//Route::post('reset-password', [AuthenticatedSessionController::class, 'resetPassword'])->name('password.reset');

// Route::get('/laptop', [UserController::class, 'laptop'])->middleware(['auth','verified'])->name('laptop.open');
// Route::get('/watch', [UserController::class, 'watch'])->middleware(['auth','verified'])->name('watch.open');
// Route::get('/phone', [UserController::class, 'phone'])->middleware(['auth','verified'])->name('phone.open');
// Route::get('/buy', [UserController::class, 'buy'])->middleware(['auth','verified'])->name('buy.open');      
// Route::post('/add-to-cart', 'CartController@addToCart')->name('addToCart');