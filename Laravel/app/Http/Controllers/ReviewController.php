<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    // Menampilkan semua review dalam view
    public function index()
    {
        $reviews = Http::get('http://localhost:9008/reviews')->json();

        return view('review.index', ['reviews' => $reviews]);
    }

    // Menampilkan form untuk menambahkan review baru
    public function createView()
    {

        return view('review.create');
    }

    // Menyimpan review baru
    public function store(Request $request)
    {
        Http::post('http://localhost:9008/reviews', $request->all());

        return redirect()->route('review.index')->with('success', 'Review added successfully.');
    }

    // Menampilkan detail review
  public function showView($id)
{
    // Ambil data review dari server berdasarkan ID yang diberikan
    $response = Http::get("http://localhost:9008/reviews/{$id}");
    
    // Periksa apakah request berhasil
    if ($response->successful()) {
        // Jika berhasil, ambil data review dari respons JSON
        $review = $response->json();
    } else {
        // Jika tidak berhasil, set review menjadi null atau data kosong sesuai kebutuhan
        $review = null;
    }

    // Kirim data review ke tampilan 'review.show'
    return view('review.show', ['review' => $review]);
}

    // Menampilkan form untuk mengedit review
    public function editView($id)
    {
        $review = Http::get("http://localhost:9008/reviews/{$id}")->json();

        return view('review.edit', ['review' => $review]);
    }

    // Menyimpan perubahan pada review yang diedit
    public function update(Request $request, $id)
    {
        Http::put("http://localhost:9008/reviews/{$id}", $request->all());

        return redirect()->route('review.index')->with('success', 'Review updated successfully.');
    }

    // Menghapus review
    public function destroy($id)
    {
        Http::delete("http://localhost:9008/reviews/{$id}");

        return redirect()->route('review.index')->with('success', 'Review deleted successfully.');
    }
}
