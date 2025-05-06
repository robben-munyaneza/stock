@extends('components.sidebar')

@section('content')
<style>
    .dashboard {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 600px;
    }

    .dashboard h1 {
        font-size: 28px;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .dashboard p {
        font-size: 18px;
        margin-bottom: 20px;
        color: #555;
    }

    .dashboard form button {
        padding: 10px 20px;
        background-color: #e74c3c;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .dashboard form button:hover {
        background-color: #c0392b;
    }

    .dashboard a {
        display: inline-block;
        margin-top: 10px;
        color: #2980b9;
        text-decoration: none;
    }

    .dashboard a:hover {
        text-decoration: underline;
    }
</style>

<div class="dashboard">
    <h1>Welcome, {{ session('name') }}!</h1>
    <p>You are now logged in.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

</div>
@endsection
