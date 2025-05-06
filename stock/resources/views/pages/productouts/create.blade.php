@extends('components.sidebar')

@section('content')

<style>
    .form-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        max-width: 600px;
        margin: auto;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .form-container h2 {
        font-size: 24px;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-container label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
        color: #333;
    }

    .form-container select,
    .form-container input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .form-container button {
        background-color: #3498db;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .form-container button:hover {
        background-color: #2980b9;
    }

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }
</style>

<div class="form-container">
    <h2>📤 Add Product Out</h2>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('productout.store') }}" method="POST">
        @csrf

        <label for="pcode">Product Code:</label>
        <select name="pcode" id="pcode" required>
            <option value="">-- Select Product Code --</option>
            @foreach ($products as $product)
                <option value="{{ $product->pcode }}">{{ $product->pcode }} - {{ $product->pname }}</option>
            @endforeach
        </select>

        <label for="productout_date">Date:</label>
        <input type="date" id="productout_date" name="productout_date" required>

        <label for="productout_quantity">Quantity:</label>
        <input type="number" id="productout_quantity" name="productout_quantity" required>

        <label for="productout_unitprice">Unit Price:</label>
        <input type="number" step="0.01" id="productout_unitprice" name="productout_unitprice" required>

        <label for="productout_totalprice">Total Price:</label>
        <input type="number" step="0.01" id="productout_totalprice" name="productout_totalprice" value="{{ old('productout_totalprice') }}" readonly>

        <button type="submit">✅ Submit</button>
    </form>
</div>

{{-- ✅ JavaScript to auto-calculate total price --}}
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
