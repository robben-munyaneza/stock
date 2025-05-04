@extends('components.sidebar')
@section('content')

<h2>Product In List</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('productin.create') }}">➕ Add New Product In</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
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
                <td>
                    <a href="{{ route('productin.edit', $productin->id) }}">✏️ Edit</a> |
                    <form action="{{ route('productin.destroy', $productin->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8">No product entries found.</td></tr>
        @endforelse
    </tbody>
</table>

@endsection
