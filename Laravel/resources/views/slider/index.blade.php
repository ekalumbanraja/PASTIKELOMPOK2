<!-- resources/views/sliders/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daftar Slider</h1>
    <a href="{{ route('sliders.create') }}" class="btn btn-primary">Tambah Slider</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image URL</th>
                <th>Caption</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                <tr>
                    <td>{{ $slider['ID'] }}</td>
                    <td>{{ $slider['ImageURL'] }}</td>
                    <td>{{ $slider['Caption'] }}</td>
                    <td>
                        <a href="{{ route('sliders.edit', $slider['ID']) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('sliders.destroy', $slider['ID']) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
