@extends('components.sidebar')
@section('content')

<h2>Edit Product Out</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('productout.update', $productout->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="pcode">Product Code:</label><br>
    <select name="pcode" id="pcode" required>
        <option value="">-- Select Product Code --</option>
        @foreach ($products as $product)
            <option value="{{ $product->pcode }}" 
                {{ $product->pcode == $productout->pcode ? 'selected' : '' }}>
                {{ $product->pcode }} - {{ $product->pname }}
            </option>
        @endforeach
    </select><br><br>

    <label for="productout_date">Date:</label><br>
    <input type="date" id="productout_date" name="productout_date" value="{{ $productout->productout_date }}" required><br><br>

    <label for="productout_quantity">Quantity:</label><br>
    <input type="number" id="productout_quantity" name="productout_quantity" value="{{ $productout->productout_quantity }}" required><br><br>

    <label for="productout_unitprice">Unit Price:</label><br>
    <input type="number" step="0.01" id="productout_unitprice" name="productout_unitprice" value="{{ $productout->productout_unitprice }}" required><br><br>

    <label for="productout_totalprice">Total Price:</label><br>
    <input type="number" step="0.01" id="productout_totalprice" name="productout_totalprice" value="{{ $productout->productin_totalprice }}" readonly required><br><br>

    <button type="submit">Update</button>
</form>

{{-- ✅ JavaScript to auto-update total price --}}
<script>
    const qtyInput = document.getElementById('productout_quantity');
    const priceInput = document.getElementById('productout_unitprice');
    const totalInput = document.getElementById('productout_totalprice');

    function updateTotal() {
        const qty = parseFloat(qtyInput.value);
        const price = parseFloat(priceInput.value);
        if (!isNaN(qty) && !isNaN(price)) {
            totalInput.value = (qty * price).toFixed(2);
        } else {
            totalInput.value = '';
        }
    }

    qtyInput.addEventListener('input', updateTotal);
    priceInput.addEventListener('input', updateTotal);
</script>

@endsection
