<!DOCTYPE html>
<html>
<head>
    <title>Login User</title>
</head>
<body>
    <h1>Login User</h1>

    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
        </div>

        <button type="submit">Login User</button>
    </form>

    <p><a href="{{ route('admin.login') }}">Login sebagai admin</a></p>
</body>
</html>
