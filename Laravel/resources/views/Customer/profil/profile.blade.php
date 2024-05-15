<!-- resources/views/profile.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Profile Detail</title>
</head>
<body>
    <h1>Profile Detail</h1>
    <p>ID: {{ $profile['id'] }}</p>
    <p>Name: {{ $profile['name'] }}</p>
    <p>Email: {{ $profile['email'] }}</p>
    <a href="/profiles">Back to Profiles</a>
</body>
</html>
