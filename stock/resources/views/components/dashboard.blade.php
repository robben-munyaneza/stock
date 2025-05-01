@extends('components.sidebar')

@section('content')
<h1>Welcome, {{ session('name') }}!</h1>
<p>You are now logged in.</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

<a href="/logout">Logout</a>
@endsection

