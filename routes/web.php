<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;

use Illuminate\Support\Facades\Route;

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
    return view('User.home', [
        'products' => Product::latest()->limit(3)->get(),
    ]);
});

Route::get('/menu', function () {
    return view('User.menu', [
        'products' => Product::latest()->get(),
    ]);
});

// Order
Route::get('/order/{product}', [OrderController::class, 'create']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/detail-order/{order}', [OrderController::class, 'show']);
Route::post("/upload-pembayaran/{order}", [OrderController::class, 'uploadPembayaran']);


Route::get('/dashboard', function () {
    return view('Admin.dashboard', [
       'penjualanBulanIni' => Order::orderBulanIni(), 
        'jumlahProduk' => Product::all()->count(), 
        'pendapatanBulanIni' =>  Order::pendapatanBulanIni()->get()->sum('total_harga'),
        'jumlahPengguna' => Customer::all()->count() 
    ]);
});

Route::get('/profile', [CustomerController::class, 'show']);
// update profile : 
Route::post('/profile/update', [CustomerController::class, 'updateProfile']);


Route::get('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'index']);

Route::post('/register', [CustomerController::class, 'store']);
Route::post('/login', [AuthController::class, 'authenticate']);

// ================================= ADMIN =============================
Route::resource('/product', ProductController::class);
Route::resource('orders', OrderController::class);
Route::get('/detail-order-admin/{order} ', [OrderController::class, 'detailOrderAdmin']);
Route::post('/set-status/{order}', [OrderController::class, 'setStatus']);
Route::delete('/order/{order}', [OrderController::class, 'destroy']);
Route::resource('/customer', CustomerController::class);
Route::get('/laporan', [OrderController::class, 'laporan']);
Route::get('/laporan/pdf', [OrderController::class, 'pdf']);

// Route::resource('/customer', CustomerController::class);