
@extends('layouts.customer')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reviews</title>
</head>
<body>
    <h1>All Reviews</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Rating</th>
                <th>Actions</th> <!-- Kolom baru untuk actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews['data'] as $review)
            <tr>
                <td>{{ $review['ID'] }}</td>
                <td>{{ $review['title'] }}</td>
                <td>{{ $review['content'] }}</td>
                <td>{{ $review['rating'] }}</td>
                <td>
                    <a href="{{ route('review.show', ['id' => $review['ID']]) }}">Show</a> |
                    <a href="{{ route('review.edit', ['id' => $review['ID']]) }}">Edit</a> |
                    <form action="{{ route('review.destroy', ['id' => $review['ID']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

@endsection