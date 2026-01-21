<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('User.orderSeblak', ['menu' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. VALIDASI
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'level_pedas' => 'required',
            'keterangan' => 'required|string|max:255',
        ]);

        // 2. AMBIL DATA MENU
        $menu = Product::findOrFail($request->product_id);

        // 3. CEK STOK
        if ($request->jumlah > $menu->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        // 4. HITUNG TOTAL (AMAN)
        $totalHarga = $menu->harga * $request->jumlah;

        // 5. SIMPAN ORDER
        DB::transaction(function () use ($request, $menu, $totalHarga) {
            // 1. Buat Data Order
            Order::create([
                'customer_id' => $request->customer_id,
                'product_id' => $menu->id,
                'jumlah' => $request->jumlah,
                'harga' => $menu->harga,
                'total_harga' => $totalHarga,
                'level_pedas' => $request->level_pedas,
                'keterangan' => $request->keterangan,
            ]);

            // 2. Kurangi Stok Menu
            $menu->update([
                'jumlah' => $menu->jumlah - $request->jumlah,
            ]);
        });

        return 'Berhasil memesan';

        return redirect('/')
            ->with('success', 'Pesanan berhasil dibuat 🔥');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('User.detail-order-seblak', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
