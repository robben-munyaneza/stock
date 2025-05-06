@extends('components.sidebar')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 30px;
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    h1, h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 40px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
        padding: 12px;
        text-align: center;
    }

    td {
        padding: 10px;
        text-align: center;
        background-color: #fff;
    }

    tfoot th {
        font-weight: bold;
        background-color: #f1f1f1;
    }

    .profit-positive {
        color: green;
        font-weight: bold;
    }

    .profit-negative {
        color: red;
        font-weight: bold;
    }
</style>

<div class="container">
    <h1>📊 Daily and Monthly Report</h1>

    {{-- =========== DAILY REPORT ============ --}}
    <h2>📅 Daily Report for {{ $dailyDate }}</h2>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>In Qty</th>
                <th>In Total</th>
                <th>Out Qty</th>
                <th>Out Total</th>
                <th>Profit / Loss</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dailyProducts as $product)
                @php
                    $inQty = $product->productins->sum('productin_quantity');
                    $inTotal = $product->productins->sum(fn($in) => $in->productin_quantity * $in->productin_unitprice);
                    $outQty = $product->productouts->sum('productout_quantity');
                    $outTotal = $product->productouts->sum(fn($out) => $out->productout_quantity * $out->productout_unitprice);
                    $profit = $outTotal - $inTotal;
                @endphp
                <tr>
                    <td>{{ $product->pname }}</td>
                    <td>{{ $inQty }}</td>
                    <td>{{ number_format($inTotal, 2) }}</td>
                    <td>{{ $outQty }}</td>
                    <td>{{ number_format($outTotal, 2) }}</td>
                    <td class="{{ $profit >= 0 ? 'profit-positive' : 'profit-negative' }}">
                        {{ number_format($profit, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $dailyTotalProfit = $dailyProducts->reduce(function ($carry, $product) {
                    $inTotal = $product->productins->sum(fn($in) => $in->productin_quantity * $in->productin_unitprice);
                    $outTotal = $product->productouts->sum(fn($out) => $out->productout_quantity * $out->productout_unitprice);
                    return $carry + ($outTotal - $inTotal);
                }, 0);
            @endphp
            <tr>
                <th colspan="5" style="text-align: right">Total Profit / Loss:</th>
                <th class="{{ $dailyTotalProfit >= 0 ? 'profit-positive' : 'profit-negative' }}">
                    {{ number_format($dailyTotalProfit, 2) }}
                </th>
            </tr>
        </tfoot>
    </table>

    {{-- =========== MONTHLY REPORT ============ --}}
    <h2>🗓️ Monthly Report for {{ \Carbon\Carbon::parse($monthlyMonth)->format('F Y') }}</h2>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>In Qty</th>
                <th>In Total</th>
                <th>Out Qty</th>
                <th>Out Total</th>
                <th>Profit / Loss</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyProducts as $product)
                @php
                    $inQty = $product->productins->sum('productin_quantity');
                    $inTotal = $product->productins->sum(fn($in) => $in->productin_quantity * $in->productin_unitprice);
                    $outQty = $product->productouts->sum('productout_quantity');
                    $outTotal = $product->productouts->sum(fn($out) => $out->productout_quantity * $out->productout_unitprice);
                    $profit = $outTotal - $inTotal;
                @endphp
                <tr>
                    <td>{{ $product->pname }}</td>
                    <td>{{ $inQty }}</td>
                    <td>{{ number_format($inTotal, 2) }}</td>
                    <td>{{ $outQty }}</td>
                    <td>{{ number_format($outTotal, 2) }}</td>
                    <td class="{{ $profit >= 0 ? 'profit-positive' : 'profit-negative' }}">
                        {{ number_format($profit, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $monthlyTotalProfit = $monthlyProducts->reduce(function ($carry, $product) {
                    $inTotal = $product->productins->sum(fn($in) => $in->productin_quantity * $in->productin_unitprice);
                    $outTotal = $product->productouts->sum(fn($out) => $out->productout_quantity * $out->productout_unitprice);
                    return $carry + ($outTotal - $inTotal);
                }, 0);
            @endphp
            <tr>
                <th colspan="5" style="text-align: right">Total Profit / Loss:</th>
                <th class="{{ $monthlyTotalProfit >= 0 ? 'profit-positive' : 'profit-negative' }}">
                    {{ number_format($monthlyTotalProfit, 2) }}
                </th>
            </tr>
        </tfoot>
    </table>
</div>

@endsection
