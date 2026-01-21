<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Product.index', [
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:100|unique:products',
            'harga'     => 'required|numeric|min:1',
            // 'kategori'  => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:200',
            'jumlah'    => 'required|integer|min:0',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. UPLOAD GAMBAR (MOVE)
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/produk'), $namaFile);

            $validated['gambar'] = $namaFile;
        }

        // 3. SIMPAN DATA
        Product::create($validated);

        // 4. REDIRECT
        return redirect('product')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('Admin.Product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // VALIDASI
        $validated = $request->validate([
            'nama'      => 'required|string|max:100|unique:products,nama,' . $product->nama,
            'harga'     => 'required|numeric|min:1',
            // 'kategori'  => 'required|string|max:50',
            'jumlah'    => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:200',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // JIKA ADA GAMBAR BARU
        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            $oldPath = public_path('uploads/produk/' . $product->gambar);
            // if (file_exists($oldPath)) {
            //     unlink($oldPath);
            // }

            File::delete('uploads/produk/' . $product->gambar);
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $namaFile);

            $validated['gambar'] = $namaFile;
        }

        $product->update($validated);

        return redirect('product')
            ->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        File::delete('uploads/produk/' . $product->gambar);
        
        $product->delete();

        return back()->with('success', "Berhasil menghapus data");
    }
}
