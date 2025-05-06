@extends('components.sidebar')

@section('content')

<style>
    .product-container {
        max-width: 900px;
        margin: auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .product-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .add-button {
        display: inline-block;
        margin-bottom: 15px;
        padding: 10px 18px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .add-button:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    td a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    td a:hover {
        text-decoration: underline;
    }

    form button {
        padding: 6px 12px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    form button:hover {
        background-color: #c82333;
    }
</style>

<div class="product-container">
    <h2>📦 PRODUCTS LIST</h2>

    <a href="{{ route('products.create') }}" class="add-button">➕ Add Product</a>

    <table>
        <tr>
            <th>Product Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->pname }}</td>
                <td><a href="{{ route('products.edit', $product->pcode) }}">✏️ Edit</a></td>
                <td>
                    <form action="{{ route('products.destroy', $product->pcode) }}" method="POST" onsubmit="return confirm('Do you want to delete the product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

@endsection
