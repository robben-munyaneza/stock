<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
</head>
<body>
    <form action="{{route("login")}}" method="POST">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username" value="">
        <label for="password">password</label>
        <input type="password" name="password" value="">
        <button type="submit">Register</button>
    </form>
</body>
</html>