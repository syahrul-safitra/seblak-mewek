<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::get('/dashboard', function () {
    return view('Admin.dashboard');
});

Route::get('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'index']);

Route::post('/register', [CustomerController::class, 'store']);
Route::post('/login', [AuthController::class, 'authenticate']);

Route::resource('/product', ProductController::class);
