<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | {{ env('APP_NAME') ?? 'Laravel v12 Admin Panel' }}</title>
</head>
<body>
    <h1>Dashboard</h1><br><br>

    <form action="{{ route('admin.logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>