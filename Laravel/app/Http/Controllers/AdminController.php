<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function insert(Request $request)
    {
        // Kirim permintaan HTTP POST ke endpoint Golang untuk menyimpan kategori
        $response = Http::post('http://localhost:9900/api/category', [
            'category_name' => $request->input('category_name')
        ]);

        // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            // Jika berhasil, kembalikan ke tampilan tampilcategory dengan pesan sukses
            return redirect()->route('tampil_category')->with('success', 'Kategori berhasil ditambahkan');
        } else {
            // Jika gagal, kembalikan dengan pesan kesalahan
            return back()->with('error', 'Failed to insert category');
        }
    }

    public function delete($id)
    {
        // Kirim permintaan HTTP DELETE ke endpoint Golang untuk menghapus kategori berdasarkan ID
        $response = Http::delete("http://localhost:9900/api/category/{$id}");

        // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            // Jika berhasil, kembalikan ke tampilan tampilcategory
            return redirect()->back()->with('success', 'Kategori berhasil dihapus');
        } else {
            // Jika gagal, kembalikan dengan pesan kesalahan
            return back()->with('error', 'Failed to delete category');
        }
    }

    public function index()
    {
        // Kirim permintaan HTTP GET untuk mengambil semua kategori dari aplikasi Golang
        $response = Http::get('http://localhost:9900/api/category');

        // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            // Jika berhasil, ambil data kategori dari respons
            $data = $response->json(); // Ambil data dari respons JSON
        } else {
            // Jika gagal, atur $data menjadi array kosong
            $data = [];
        }

        // Kembalikan tampilan dengan data kategori
        return view('admin.category.category', compact('data'));
    }

    public function tampilcategory()
    {
        // Lakukan logika untuk menampilkan tampilan tampilcategory di sini
        return view('admin.category.tampilcategory');
    }
}
