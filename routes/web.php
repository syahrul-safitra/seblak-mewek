<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Customer;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

    if (Auth::guard('admin')->check()) {
        return redirect('/dashboard');
    }

    return view('User.home', [
        'products' => Product::latest()->limit(3)->get(),
        'no_wa' => User::select('no_wa')->first() 
    ]);
});

Route::get('/menu', function () {
    return view('User.menu', [
        'products' => Product::latest()->get(),
        'no_wa' => User::select('no_wa')->first()
    ]);
});

//==========================================  Customer ========================================================= 
Route::get('/order/{product}', [OrderController::class, 'create'])->middleware('isCustomer');
Route::post('/order', [OrderController::class, 'store'])->middleware('isCustomer');
Route::get('/detail-order/{order}', [OrderController::class, 'show'])->middleware('isCustomer');
Route::post("/upload-pembayaran/{order}", [OrderController::class, 'uploadPembayaran'])->middleware('isCustomer');

Route::get('/profile', [CustomerController::class, 'show']);
// update profile : 
Route::post('/profile/update', [CustomerController::class, 'updateProfile']);


Route::get('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'index']);

Route::post('/register', [CustomerController::class, 'store']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

// ================================= ADMIN =============================
Route::get('/dashboard', function () {
    return view('Admin.dashboard', [
       'penjualanBulanIni' => Order::orderBulanIni(), 
        'jumlahProduk' => Product::all()->count(), 
        'pendapatanBulanIni' =>  Order::pendapatanBulanIni()->get()->sum('total_harga'),
        'jumlahPengguna' => Customer::all()->count() 
    ]);
})->middleware('isAdmin');
Route::resource('/product', ProductController::class)->middleware('isAdmin');
Route::resource('orders', OrderController::class)->middleware('isAdmin');
Route::get('/detail-order-admin/{order} ', [OrderController::class, 'detailOrderAdmin'])->middleware('isAdmin');
Route::post('/set-status/{order}', [OrderController::class, 'setStatus'])->middleware('isAdmin');
Route::delete('/order/{order}', [OrderController::class, 'destroy'])->middleware('isAdmin');
Route::resource('/customer', CustomerController::class)->middleware('isAdmin');
Route::get('/laporan', [OrderController::class, 'laporan'])->middleware('isAdmin');
Route::get('/laporan/pdf', [OrderController::class, 'pdf'])->middleware('isAdmin');
Route::get("/set-admin", function() {
    return view('Admin.edit', [
        'admin' => User::first()
    ]);
})->middleware('isAdmin');

Route::put('/set-admin/{admin}', function(Request $request, User $admin) {
      $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:customers|unique:admin,email,' . $admin->id,
        'no_wa' => 'nullable',
        'password' => 'nullable|max:10'
    ]);

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    } else {
        unset($data['password']);
    }

    $admin->update($data);

    return redirect('set-admin')->with('success', 'Admin berhasil diperbarui');   
})->middleware('isAdmin');

// Route::resource('/customer', CustomerController::class);

Route::get('/test1', function () {
    return Auth::guard('customer')->user();
});

Route::get('/test2', function () {
    return Auth::guard('admin')->user();
});