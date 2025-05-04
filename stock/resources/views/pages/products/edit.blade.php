@extends('components.sidebar')

@section('content')
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $products->pcode) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="pname">Product Name:</label>
        <input type="text" name="pname" id="pname" value="{{ $products->pname }}" required><br><br>

        <button type="submit">Update Product</button>
    </form>
@endsection
