@extends('components.sidebar')

@section('content')

<style>
    .list-container {
        max-width: 1000px;
        margin: auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .list-container h2 {
        font-size: 24px;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }

    .add-button {
        background-color: #28a745;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        display: inline-block;
        margin-bottom: 20px;
    }

    .add-button:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .action-buttons a {
        margin-right: 10px;
        color: #007bff;
        text-decoration: none;
    }

    .action-buttons a:hover {
        text-decoration: underline;
    }

    .action-buttons form {
        display: inline;
    }

    .action-buttons button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    .action-buttons button:hover {
        background-color: #c82333;
    }
</style>

<div class="list-container">
    <h2>📋 Product Out List</h2>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <a href="{{ route('productout.create') }}" class="add-button">➕ Add New Product Out</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productouts as $productout)
                <tr>
                    <td>{{ $productout->id }}</td>
                    <td>{{ $productout->pcode }}</td>
                    <td>{{ $productout->product->pname ?? 'N/A' }}</td>
                    <td>{{ $productout->productout_date }}</td>
                    <td>{{ $productout->productout_quantity }}</td>
                    <td>{{ $productout->productout_unitprice }}</td>
                    <td>{{ $productout->productout_totalprice }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('productout.edit', $productout->id) }}">✏️ Edit</a>
                        <form action="{{ route('productout.destroy', $productout->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No product entries found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
