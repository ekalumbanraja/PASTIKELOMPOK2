<!-- resources/views/profiles.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Profiles</title>
</head>
<body>
    <h1>Profiles</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach ($profiles as $profile)
        <tr>
            <td>{{ $profile['id'] }}</td>
            <td>{{ $profile['name'] }}</td>
            <td>{{ $profile['email'] }}</td>
            <td>
                <a href="/profiles/{{ $profile['id'] }}">View</a>
                <a href="/profiles/{{ $profile['id'] }}/edit">Edit</a>
                <form action="/profiles/{{ $profile['id'] }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
