<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("Admin.Costumer.index", [
            'customers' => Customer::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:admin|unique:customers|max:50',
            'password' => 'required|max:10',
            'no_wa' => 'required|max:15',
            'alamat' => 'required|max:200',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Upload foto (jika ada)
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/customer', $namaFoto);
        }

        // 3. Simpan ke database
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
            'foto' => $namaFoto,
        ]);

        // 4. Redirect
        return redirect('/login')->with('success', 'Berhasil registrasi');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $customer = Customer::findOrFail(Auth::guard('customer')->user()->id);

        $orders = Order::with('product')
        ->where('customer_id', $customer->id)
        ->latest()
        ->get();

        $no_wa = User::select('no_wa')->first();

    return view('User.profile', compact('customer', 'orders', 'no_wa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('Admin.Costumer.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:admin|unique:customers,email,' . $customer->id,
            'no_wa' => 'required|max:15',
            'alamat' => 'required|max:200',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|max:10',
        ]);

        $data = $request->only(['name', 'email', 'no_wa', 'alamat']);

        // jika ada foto baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = 'foto_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/customer'), $namaFile);
            $data['foto'] = $namaFile;
        }

        // jika password diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $customer->update($data);

        return redirect('customer')->with('success', 'Data customer berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        File::delete('uploads/customer/' . $customer->foto);
        
        $customer->delete();

        return back()->with('success', "Berhasil menghapus data customer");
    
    }

    public function updateProfile(Request $request)
    {
        $customer = Customer::findOrFail(Auth::guard('customer')->user()->id);

        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'no_wa' => 'required|max:15',
            'alamat' => 'required|max:200',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|max:10',
        ]);

        $data = $request->only(['name', 'email', 'no_wa', 'alamat']);

        // jika ada foto baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = 'foto_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/customer'), $namaFile);
            $data['foto'] = $namaFile;
        }

        // jika password diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $customer->update($data);

        return back()->with('success', 'Profile berhasil diperbarui');
    }

}
