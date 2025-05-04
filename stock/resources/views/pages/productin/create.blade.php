@extends('components.sidebar')
@section('content')

<h2>Add Product In</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('productin.store') }}" method="POST">
    @csrf

    <label for="pcode">Product Code:</label><br>
    <select name="pcode" id="pcode" required>
        <option value="">-- Select Product Code --</option>
        @foreach ($products as $product)
            <option value="{{ $product->pcode }}">{{ $product->pcode }} - {{ $product->pname }}</option>
        @endforeach
    </select><br><br>

    <label for="productin_date">Date:</label><br>
    <input type="date" id="productin_date" name="productin_date" required><br><br>

    <label for="productin_quantity">Quantity:</label><br>
    <input type="number" id="productin_quantity" name="productin_quantity" required><br><br>

    <label for="productin_unitprice">Unit Price:</label><br>
    <input type="number" step="0.01" id="productin_unitprice" name="productin_unitprice" required><br><br>

    <label for="productin_totalprice">Total Price:</label><br>
    <input type="number" step="0.01" id="productin_totalprice" name="productin_totalprice" value="{{ old('productin_totalprice') }}" readonly><br><br>

    <button type="submit">Submit</button>
</form>

{{-- ✅ Add this JavaScript at the bottom of your Blade file --}}
<script>
    const quantityInput = document.getElementById('productin_quantity');
    const unitPriceInput = document.getElementById('productin_unitprice');
    const totalPriceInput = document.getElementById('productin_totalprice');

    function calculateTotal() {
        const qty = parseFloat(quantityInput.value);
        const price = parseFloat(unitPriceInput.value);
        if (!isNaN(qty) && !isNaN(price)) {
            totalPriceInput.value = (qty * price).toFixed(2);
        } else {
            totalPriceInput.value = '';
        }
    }

    quantityInput.addEventListener('input', calculateTotal);
    unitPriceInput.addEventListener('input', calculateTotal);
</script>

@endsection
