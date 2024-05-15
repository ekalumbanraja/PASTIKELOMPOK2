<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        // Mengambil data slider dari aplikasi GoLang menggunakan HTTP request
        $response = Http::get('http://localhost:9009/sliders');
        $sliders = $response->json()['data'];

        // Tampilkan halaman daftar slider dengan data yang diterima
        return view('slider.index', compact('sliders'));
    }   

    public function create()
    {
        // Tampilkan formulir untuk membuat slider baru
        return view('slider.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required',
        ]);
    
        // Upload gambar ke direktori public/slider
        $file = $request->file('image');
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('slider'), $imageName);
    
        // Cek apakah gambar benar-benar diunggah
        if (!file_exists(public_path('slider/' . $imageName))) {
            return back()->with('error', 'Gagal mengunggah gambar.');
        }
    
        // URL gambar yang akan dikirim ke server GoLang
        $imageUrl = '/slider/' . $imageName;
    
        // Debug untuk memastikan gambar diunggah dan URL gambar benar
        // dd($imageUrl);
    
        // Request ke server GoLang untuk menyimpan data slider
        $response = Http::post('http://localhost:9009/sliders', [
            'image_url' => $imageUrl,
            'caption' => $request->caption,
        ]);
    
        // Debug untuk memeriksa respons dari server GoLang
        // dd($response->json());
    
        // Cek status response dari server GoLang
        if ($response->successful()) {
            return redirect()->route('sliders.index')->with('success', 'Slider berhasil ditambahkan.');
        } else {
            return back()->with('error', 'Gagal menambahkan slider. Silakan coba lagi.');
        }
    }
    
    

    public function edit($id)
    {
        // Mengambil data slider yang akan diedit dari aplikasi GoLang menggunakan HTTP request
        $response = Http::get('http://localhost:9009/sliders/'.$id);
        $slider = $response->json()['data'];

        // Tampilkan formulir untuk mengedit slider dengan data yang diterima
        return view('slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        // Kirim permintaan PUT ke aplikasi GoLang untuk memperbarui slider yang ada
        $response = Http::put('http://localhost:9009/sliders/'.$id, [
            'image_url' => $request->input('image_url'),
            'caption' => $request->input('caption'),
        ]);

        // Redirect kembali ke halaman utama setelah memperbarui
        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {
        // Kirim permintaan DELETE ke aplikasi GoLang untuk menghapus slider
        $response = Http::delete('http://localhost:9009/sliders/'.$id);

        // Redirect kembali ke halaman utama setelah menghapus
        return redirect()->route('slider.index');
    }
}
