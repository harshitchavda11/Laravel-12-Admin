<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ env('APP_NAME') ?? 'Laravel v12 Admin Panel' }}</title>
</head>
<body>
    <form action="{{ route('admin.login') }}" method="post">
        @csrf
        <div>
            <input type="email" name="email" id="" placeholder="Name"><br>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>
        </br>
        <div>
            <input type="password" name="password" id="" placeholder="Secret"><br>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" value="Login">Login</button>
        </div>
    </form>
</body>
</html>