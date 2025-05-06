@extends('components.sidebar')

@section('content')

<style>
    .list-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        max-width: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .list-container h2 {
        font-size: 24px;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .add-button {
        background-color: #3498db;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .add-button:hover {
        background-color: #2980b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
        font-weight: bold;
        color: #333;
    }

    tr:nth-child(even) {
        background-color: #fafafa;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .actions a,
    .actions button {
        margin: 0 4px;
        text-decoration: none;
        font-size: 14px;
    }

    .actions a {
        color: #2980b9;
    }

    .actions button {
        background-color: transparent;
        border: none;
        color: #c0392b;
        cursor: pointer;
        font-weight: bold;
    }

    .actions button:hover {
        color: #e74c3c;
    }

    .actions a:hover {
        color: #1f618d;
    }
</style>

<div class="list-container">
    <h2>📦 Product In List</h2>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <a href="{{ route('productin.create') }}" class="add-button">➕ Add New Product In</a>

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
            @forelse($productins as $productin)
                <tr>
                    <td>{{ $productin->id }}</td>
                    <td>{{ $productin->pcode }}</td>
                    <td>{{ $productin->product->pname ?? 'N/A' }}</td>
                    <td>{{ $productin->productin_date }}</td>
                    <td>{{ $productin->productin_quantity }}</td>
                    <td>{{ $productin->productin_unitprice }}</td>
                    <td>{{ $productin->productin_totalprice }}</td>
                    <td class="actions">
                        <a href="{{ route('productin.edit', $productin->id) }}">✏️ Edit</a>
                        <form action="{{ route('productin.destroy', $productin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">🗑️</button>
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
