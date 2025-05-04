@extends('components.sidebar')
@section('content')

<h2>Edit Product In</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('productin.update', $productin->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="pcode">Product Code:</label><br>
    <select name="pcode" id="pcode" required>
        <option value="">-- Select Product Code --</option>
        @foreach ($products as $product)
            <option value="{{ $product->pcode }}" 
                {{ $product->pcode == $productin->pcode ? 'selected' : '' }}>
                {{ $product->pcode }} - {{ $product->pname }}
            </option>
        @endforeach
    </select><br><br>

    <label for="productin_date">Date:</label><br>
    <input type="date" id="productin_date" name="productin_date" value="{{ $productin->productin_date }}" required><br><br>

    <label for="productin_quantity">Quantity:</label><br>
    <input type="number" id="productin_quantity" name="productin_quantity" value="{{ $productin->productin_quantity }}" required><br><br>

    <label for="productin_unitprice">Unit Price:</label><br>
    <input type="number" step="0.01" id="productin_unitprice" name="productin_unitprice" value="{{ $productin->productin_unitprice }}" required><br><br>

    <label for="productin_totalprice">Total Price:</label><br>
    <input type="number" step="0.01" id="productin_totalprice" name="productin_totalprice" value="{{ $productin->productin_totalprice }}" readonly required><br><br>

    <button type="submit">Update</button>
</form>

{{-- ✅ JavaScript to auto-update total price --}}
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
