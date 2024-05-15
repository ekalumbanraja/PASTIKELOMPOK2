@extends('layouts.admin')
@section('title', 'Category')

@section('content')
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-windows"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Category Produk</h2>
                                    <p>Welcome to category product <span class="bread-ntd">table</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Tambah category" class="btn"
                                    onclick="window.location='{{ route('tampil_category') }}'">
                                    <i class="notika-icon notika-sent"></i>
                                </button>
                            </div>
                        </div>
                        <div class="normal-table-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list">
                                            <div class="bsc-tbl">
                                                <table class="table table-sc-ex">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Category Produk</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $index => $category)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $category['category_name'] }}</td>
                                                            <td>
                                                                @if (isset($category['ID']))
                                                                <button class="btn btn-warning notika-btn-danger"
                                                                    onclick="confirmDelete({{ $category['ID'] }})">Delete</button>
                                                                @else
                                                                <p>ID not available</p>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert script -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    function confirmDelete(categoryId) {
        swal({
            title: "Yakin ingin menghapus?",
            text: "Data akan hilang jika dihapus!",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: {
                    text: "Hapus",
                    value: true,
                    visible: true,
                    className: "btn-danger",
                }
            },
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Jika pengguna menekan "Hapus", arahkan ke route delete dengan menyertakan ID
                window.location.href = "{{ route('delete_category', ':id') }}".replace(':id', categoryId);
                swal("Category berhasil dihapus!", {
                    icon: "success",
                    timer: 1500,
                    buttons: false,
                });
            } else {
                swal("Operasi dibatalkan.", {
                    icon: "info",
                    buttons: false,
                    timer: 1500,
                });
            }
        });
    }

    function berhasil() {
        swal({
            title: "Berhasil",
            text: "Kategori berhasil ditambahkan",
            icon: "success",
            buttons: false,
            timer: 1500,
        });
    }

    setTimeout(function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 3000);
</script>

@endsection
