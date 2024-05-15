<!-- resources/views/aboutus/edit.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Edit About Us Entry</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('aboutus.update', $aboutus['ID']) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $aboutus['Title'] }}" required>
        </div>
        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" required>{{ $aboutus['Content'] }}</textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('aboutus.index') }}">Back to list</a>
@endsection
