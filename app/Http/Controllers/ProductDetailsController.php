<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductDetailsController extends Controller
{
    public function showProductDetails($id)
    {
        // Debug: cek ID yang diterima
        dd('ID diterima:', $id);

        // Cari produk berdasarkan ID
        $product = Product::find($id);

        // Debug: cek hasil pencarian produk
        dd('Produk ditemukan:', $product);

        // Jika produk tidak ditemukan, tampilkan error atau halaman 404
        if (!$product) {
            abort(404, 'Product not found');
        }

        // Debug: cek data yang akan dikirim ke view
        dd('Data untuk view:', $product);

        // Kembalikan tampilan dengan data produk
        return view('product', compact('product'));
    }
}
