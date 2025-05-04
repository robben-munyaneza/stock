@extends('components.sidebar')
@section('content')

<h2>Product Out List</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('productout.create') }}">➕ Add New Product Out</a>
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
        @forelse($productouts as $productout)
            <tr>
                <td>{{ $productout->id }}</td>
                <td>{{ $productout->pcode }}</td>
                <td>{{ $productout->product->pname ?? 'N/A' }}</td>
                <td>{{ $productout->productout_date }}</td>
                <td>{{ $productout->productout_quantity }}</td>
                <td>{{ $productout->productout_unitprice }}</td>
                <td>{{ $productout->productout_totalprice }}</td>
                <td>
                    <a href="{{ route('productout.edit', $productout->id) }}">✏️ Edit</a> |
                    <form action="{{ route('productout.destroy', $productout->id) }}" method="POST" style="display:inline;">
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
