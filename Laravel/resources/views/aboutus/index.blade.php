@extends('layouts.admin')

@section('content')
<h1>About Us Entries</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (empty($aboutus))
        <p>No about us entries found.</p>
    @else
        <ul>
            @foreach ($aboutus as $entry)
                <li>
                    <strong>{{ $entry['Title'] }}:</strong> {{ $entry['Content'] }}
                    <a href="{{ route('aboutus.show', $entry['ID']) }}">View</a>
                    <a href="{{ route('aboutus.edit', $entry['ID']) }}">Edit</a>
                    <form action="{{ route('aboutus.destroy', $entry['ID']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('aboutus.create') }}">Create New Entry</a>


@endsection