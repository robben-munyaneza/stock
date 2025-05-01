<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>

<body>
    <form action="{{route("login")}}" method="POST">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username" value="">
        <label for="password">password</label>
        <input type="password" name="password" value="">
        <button type="submit">login</button>

        @if(session('error'))
        <p>{{session('error')}}</p>
        @endif
    </form>
</body>
</html>