@extends('layouts.admin')
@section('title', 'Add Category')

@section('content')

<div class="breadcomb-area py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcomb-list">
                    <div class="d-flex align-items-center">
                        <div class="breadcomb-icon">
                            <i class="notika-icon notika-windows"></i>
                        </div>
                        <div class="breadcomb-ctn ml-3">
                            <h2>Add Category Produk</h2>
                            <p>Silahkan tambahkan category product</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-3">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('tambah_category') }}">
                @csrf <!-- Laravel CSRF protection -->
                <div class="form-group">
                    <label for="category_name">Nama Kategori:</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Masukkan nama kategori" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
window.onload = function() {
    @if (session('success'))
        Swal.fire({
            title: "Success",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 1500,
            showConfirmButton: false
        });
    @elseif (session('error'))
        Swal.fire({
            title: "Error",
            text: "{{ session('error') }}",
            icon: "error",
            timer: 1500,
            showConfirmButton: false
        });
    @endif
}
</script>
@endsection
