@extends('layouts.app')

@section('content')
    <h1>Tambah Slider Baru</h1>
    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control-file" id="image" required>
        </div>
        <div class="form-group">
            <label for="caption">Caption:</label>
            <input type="text" name="caption" class="form-control" id="caption" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
