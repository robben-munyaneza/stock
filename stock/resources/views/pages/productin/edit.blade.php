@extends('components.sidebar')

@section('content')
<style>
    .form-container {
        background-color: white;
        padding: 30px;
        max-width: 700px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-container h2 {
        color: #2c3e50;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .form-container label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
        color: #333;
    }

    .form-container input,
    .form-container select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-container input:focus,
    .form-container select:focus {
        border-color: #2980b9;
        outline: none;
    }

    .form-container button {
        margin-top: 20px;
        padding: 12px 20px;
        background-color: #27ae60;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-container button:hover {
        background-color: #1e8449;
    }

    .form-container p {
        margin-top: 10px;
        color: green;
        font-weight: bold;
    }
</style>

<div class="form-container">
    <h2>Edit Product In</h2>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('productin.update', $productin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="pcode">Product Code:</label>
        <select name="pcode" id="pcode" required>
            <option value="">-- Select Product Code --</option>
            @foreach ($products as $product)
                <option value="{{ $product->pcode }}" 
                    {{ $product->pcode == $productin->pcode ? 'selected' : '' }}>
                    {{ $product->pcode }} - {{ $product->pname }}
                </option>
            @endforeach
        </select>

        <label for="productin_date">Date:</label>
        <input type="date" id="productin_date" name="productin_date" value="{{ $productin->productin_date }}" required>

        <label for="productin_quantity">Quantity:</label>
        <input type="number" id="productin_quantity" name="productin_quantity" value="{{ $productin->productin_quantity }}" required>

        <label for="productin_unitprice">Unit Price:</label>
        <input type="number" step="0.01" id="productin_unitprice" name="productin_unitprice" value="{{ $productin->productin_unitprice }}" required>

        <label for="productin_totalprice">Total Price:</label>
        <input type="number" step="0.01" id="productin_totalprice" name="productin_totalprice" value="{{ $productin->productin_totalprice }}" readonly required>

        <button type="submit">Update</button>
    </form>
</div>

<script>
    const qtyInput = document.getElementById('productin_quantity');
    const priceInput = document.getElementById('productin_unitprice');
    const totalInput = document.getElementById('productin_totalprice');

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
