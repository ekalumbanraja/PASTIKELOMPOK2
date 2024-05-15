<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
</head>
<body>
    <h1>Edit Review</h1>
    <form action="/reviews/{{ $review['data']['ID'] }}" method="post">
        @csrf
        @method('PUT')
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $review['data']['title'] }}"><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content">{{ $review['data']['content'] }}</textarea><br>
        <label for="rating">Rating:</label><br>
        <input type="number" id="rating" name="rating" min="1" max="5" value="{{ $review['data']['rating'] }}"><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
