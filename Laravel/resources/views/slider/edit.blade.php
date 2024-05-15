<!-- resources/views/sliders/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Slider</h1>
    <form action="{{ route('sliders.update', $slider['ID']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image_url">Image URL:</label>
            <input type="text" name="image_url" class="form-control" id="image_url" value="{{ $slider['ImageURL'] }}">
        </div>
        <div class="form-group">
            <label for="caption">Caption:</label>
            <input type="text" name="caption" class="form-control" id="caption" value="{{ $slider['Caption'] }}">
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
@endsection
