@extends('components.sidebar')
@section('content')

<h2>Add Product Out</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('productout.store') }}" method="POST">
    @csrf

    <label for="pcode">Product Code:</label><br>
    <select name="pcode" id="pcode" required>
        <option value="">-- Select Product Code --</option>
        @foreach ($products as $product)
            <option value="{{ $product->pcode }}">{{ $product->pcode }} - {{ $product->pname }}</option>
        @endforeach
    </select><br><br>

    <label for="productout_date">Date:</label><br>
    <input type="date" id="productout_date" name="productout_date" required><br><br>

    <label for="productout_quantity">Quantity:</label><br>
    <input type="number" id="productout_quantity" name="productout_quantity" required><br><br>

    <label for="productout_unitprice">Unit Price:</label><br>
    <input type="number" step="0.01" id="productout_unitprice" name="productout_unitprice" required><br><br>

    <label for="productout_totalprice">Total Price:</label><br>
    <input type="number" step="0.01" id="productout_totalprice" name="productout_totalprice" value="{{ old('productout_totalprice') }}" readonly><br><br>

    <button type="submit">Submit</button>
</form>

{{-- ✅ Add this JavaScript at the bottom of your Blade file --}}
<script>
    const quantityInput = document.getElementById('productout_quantity');
    const unitPriceInput = document.getElementById('productout_unitprice');
    const totalPriceInput = document.getElementById('productout_totalprice');

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
