<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Customer extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(Request $request)
    {
        // Lakukan validasi data pembelian
        $request->validate([
            'inventory_id' => 'required|exists:products,id',
        ]);

        // Lakukan logika pembelian di sini, misalnya mengurangi stok, menyimpan data pembelian ke database, dll.

        // Redirect kembali ke halaman sebelumnya atau halaman sukses pembelian
        return redirect()->back()->with('success', 'Pembelian berhasil dilakukan!');
    }
}
