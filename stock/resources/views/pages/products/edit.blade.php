@extends('components.sidebar')

@section('content')

<style>
    .form-container {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }

    .form-group input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s ease;
    }

    .form-group input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
    }

    .submit-button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-container">
    <h2>✏️ Edit Product</h2>

    <form action="{{ route('products.update', $products->pcode) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pname">Product Name:</label>
            <input type="text" name="pname" id="pname" value="{{ $products->pname }}" required>
        </div>

        <button type="submit" class="submit-button">Update Product</button>
    </form>
</div>

@endsection
