<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Detail</title>
</head>
<body>
    <h1>Review Detail</h1>
    <p><strong>Title:</strong> {{ $review['data']['title'] }}</p>
    <p><strong>Content:</strong> {{ $review['data']['content'] }}</p>
    <p><strong>Rating:</strong> {{ $review['data']['rating'] }}</p>
    <a href="/reviews/{{ $review['data']['ID'] }}/edit">Edit</a>
</body>
</html>
