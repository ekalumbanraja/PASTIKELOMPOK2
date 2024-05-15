<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;


use Illuminate\Support\Facades\Auth;

Auth::routes();

// GUEST USER
Route::get('/', function () {
    return view('welcome2');
});
Route::get('/shop', [GuestController::class, 'shop'])->name('shop');
Route::get('/product/{id}',  [GuestController::class, 'view'])->name('product.show');
Route::post('/checkout', [Customer::class, 'checkout'])->name('checkout');

// NORMAL USER
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/profiles', [ProfileController::class, 'getAllProfiles']);
Route::get('/profiles/{id}', [ProfileController::class, 'getProfileById']);
Route::post('/profiles', [ProfileController::class, 'createProfile']);
Route::put('/profiles/{id}', [ProfileController::class, 'updateProfile']);
Route::delete('/profiles/{id}', [ProfileController::class, 'deleteProfile']);

});

// ADMIN
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
//Category
    Route::get('admin/category', [AdminController::class, 'index'])->name('category.index');
    Route::get('admin/category/tampilcategory', [AdminController::class, 'tampilcategory'])->name('tampil_category');
    Route::post('admin/category/tambahcategory', [AdminController::class, 'insert'])->name('tambah_category');
    Route::get('admin/category/{id}', [AdminController::class, 'delete'])->name('delete_category');
//Product
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.Product');
    Route::get('admin/product/tampilproduct', [ProductController::class, 'tampilproduct'])->name('tampil_product');
    Route::post('admin/product/tambahproduct', [ProductController::class, 'tambahproduct'])->name('tambah_product');
    Route::get('admin/product/editproduct/{id}', [ProductController::class, 'editproduct'])->name('edit_product');
    Route::post('admin/product/updateproduct/{id}', [ProductController::class, 'updateproduct'])->name('update_product');
    Route::get('admin/product/deleteproduct/{id}', [ProductController::class, 'deleteproduct'])->name('delete_product');
});

// MANAGER
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus.index');
Route::get('/aboutus/create', [AboutUsController::class, 'create'])->name('aboutus.create');
Route::post('/aboutus', [AboutUsController::class, 'store'])->name('aboutus.store');
Route::get('/aboutus/{id}', [AboutUsController::class, 'show'])->name('aboutus.show');
Route::get('/aboutus/{id}/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit');
Route::put('/aboutus/{id}', [AboutUsController::class, 'update'])->name('aboutus.update');
Route::delete('/aboutus/{id}', [AboutUsController::class, 'destroy'])->name('aboutus.destroy');

// routes/web.php

Route::get('/reviews', [ReviewController::class, 'index'])->name('review.index');
Route::get('/reviews/create', [ReviewController::class, 'createView'])->name('review.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');
Route::get('/reviews/{id}', [ReviewController::class, 'showView'])->name('review.show');
Route::get('/reviews/{id}/edit', [ReviewController::class, 'editView'])->name('review.edit');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');


// Tampilkan halaman utama dengan daftar slider
Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');

// Tampilkan formulir untuk membuat slider baru
Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');

// Simpan slider baru ke database
Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');

// Tampilkan formulir untuk mengedit slider
Route::get('/sliders/{id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');

// Perbarui slider yang ada di database
Route::put('/sliders/{id}',[SliderController::class, 'update'])->name('sliders.update');

// Hapus slider dari database
Route::delete('/sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
