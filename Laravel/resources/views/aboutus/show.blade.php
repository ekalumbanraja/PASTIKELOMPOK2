@extends('layouts.admin')

@section('content')
    <h1>{{ $aboutus['Title'] }}</h1>
    <p>{{ $aboutus['Content'] }}</p>
    <a href="{{ route('aboutus.index') }}">Back to list</a>
@endsection
