<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("Admin.Order.index", [
            'orders' => Order::with('customer', 'product')->latest()->get()
        ]);
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
            'keterangan' => 'nullable|string|max:255',
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

        $order = null;

        $order = DB::transaction(function () use ($request, $menu, $totalHarga) {
            // 1. Buat Data Order
            $order = Order::create([
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

            return $order;
        });

        return redirect('detail-order/' . $order->id)->with('success', 'Berhasil melakukan pemesanan silahkan lakukan pembayaran dan tunggu beberapa saat dan admin akan mengkonfirmasi');
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

        if ($order->product) {
            $order->product->increment('jumlah', $order->jumlah);
        }

        if ($order->bukti && File::exists(public_path('uploads/bukti/' . $order->bukti))) {
            File::delete(public_path('uploads/bukti/' . $order->bukti));
        }

        $order->delete();

        return redirect()->back()->with('success', 'Order berhasil dihapus & stok dikembalikan');
    }

    public function uploadPembayaran(Order $order, Request $request)
    {
        // ✅ Validasi file
        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Hapus bukti lama (jika ada)
        if ($order->bukti) {
            $path = public_path('uploads/bukti/' . $order->bukti);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // ✅ Upload file baru
        $file = $request->file('bukti');
        $namaFile = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/bukti'), $namaFile);

        // ✅ Update order
        $order->update([
            'bukti' => $namaFile,
            'status' => 'menunggu_verfikasi',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Bukti pembayaran berhasil diupload');
    }

    public function detailOrderAdmin(Order $order) {
        return view("Admin.Order.edit", [
            'order' => $order
        ]);
    }

    public function setStatus(Request $request, Order $order) {
        $validation = $request->validate([
            'status' => 'required',
            'bukti' => 'max:2300'
        ]);

        $file = $request->file('bukti');

        if ($file) {

            $renameFile = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
            File::delete('uploads/bukti/' . $order->bukti);

            $order->bukti = $renameFile;

            $file->move('uploads/bukti/', $renameFile);
        }

        $getStatus = $validation['status'];

        $order->status = $getStatus;
        $order->save();

        return back()->with('success', 'Berhasil mengupdate data');
    }

    public function laporan(Request $request) {
        
        $query = Order::with(['customer', 'product'])
            ->where('status', 'berhasil');

        // FILTER TANGGAL
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return view('Admin.laporan', [
            'orders' => $orders,
            'totalOrder' => $orders->count(),
            'totalPendapatan' => $orders->sum('total_harga'),
        ]);
    }

    public function pdf(Request $request) {
        $query = Order::with(['customer', 'product'])
            ->where('status', 'berhasil');

        // Filter tanggal (opsional)
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        $data = [
            'orders' => $orders,
            'totalOrder' => $orders->count(),
            'totalPendapatan' => $orders->sum('total_harga'),
            'tanggalAwal' => $request->tanggal_awal,
            'tanggalAkhir' => $request->tanggal_akhir,
        ];

        $pdf = Pdf::loadView('Admin.pdf', $data)
            ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-penjualan.pdf');
    }

}
