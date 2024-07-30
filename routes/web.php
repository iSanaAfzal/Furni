<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FurniController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//======================Views Routes======================
Route::get('/', [FurniController::class, 'index'])->name('furni.index');
Route::get('/aboutus', [FurniController::class, 'about'])->name('furni.about');
Route::get('/blog', [FurniController::class, 'blog'])->name('furni.blog');
Route::get('/Services', [FurniController::class, 'services'])->name('furni.services');

Route::get('/shop', [FurniController::class, 'shop'])->name('furni.shop');
Route::get('/contact', [FurniController::class, 'contact'])->name('furni.contact');

// Routes with authentication
Route::middleware('auth')->group(function () {

    Route::get('/cart', [FurniController::class, 'cart'])->name('furni.cartshow');
    Route::Post('/process',[PaymentController::class,'process'])->name('process.charge');
    Route::get('/checkout', [FurniController::class, 'checkout'])->name('furni.checkout');
    Route::get('/thankyou', [FurniController::class, 'thankyou'])->name('furni.thankyou');
    Route::get('/addtocart/{id}', [FurniController::class, 'addTocart'])->name('furni.cart');
    Route::get('/removecart/{id}', [FurniController::class, 'removecart'])->name('furni.removecart');
    Route::post('/cart/update/{id}', [FurniController::class, 'update'])->name('cart.update');
    Route::post('/cart/quantity/{id}', [FurniController::class, 'productQuantity'])->name('quantity.update');
});
//================Custom Register Form Route===============
Route::get('/Register/{role}',[RegisterController::class,'showRegister'])->name('user.register');
Route::post('/custom-logout', [AdminController::class, 'logout'])->name('custom.logout');
//===================Admin View Routes=========================
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admindashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/adminusers', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/OrderDetails',[AdminController::class,'orderdetails'])->name('admin.orderdetails');
    Route::get('/order/show/{id}',[AdminController::class,'vieworder'])->name('orders.show');
    Route::get('/Products', [AdminController::class, 'Product'])->name('admin.product');
    Route::get('/productform', [AdminController::class, 'productform'])->name('admin.productform');
    Route::post('/products/store', [AdminController::class, 'productstore'])->name('products.store');
    Route::get('/products/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::get('/products/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');
    Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/edit/{id}', [AdminController::class, 'editproduct'])->name('admin.edit');
    Route::post('/admin/product/update/{id}', [AdminController::class, 'productUpdate'])->name('admin.productupdate');
    Route::post('/payment', [PaymentController::class, 'charge'])->name('stripe.payment');
});