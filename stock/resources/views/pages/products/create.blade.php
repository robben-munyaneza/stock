@extends('components.sidebar')

@section('content')
    <h2>Add New Product</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
       
        <label for="pname">Product Name:</label><br>
        <input type="text" id="pname" name="pname" required><br><br>

        <button type="submit">Add Product</button>
    </form>
@endsection
