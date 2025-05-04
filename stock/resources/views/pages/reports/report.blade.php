@extends('components.sidebar')

@section('content')
<div class="container">
    <h1>Daily and Monthly Report</h1>

    {{-- =========== DAILY REPORT ============ --}}
    <h2>Daily Report for {{ $dailyDate }}</h2>

    <table border="1" cellpadding="5" cellspacing="0">
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
                    <td style="color: {{ $profit >= 0 ? 'green' : 'red' }}">
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
                <th style="color: {{ $dailyTotalProfit >= 0 ? 'green' : 'red' }}">
                    {{ number_format($dailyTotalProfit, 2) }}
                </th>
            </tr>
        </tfoot>
    </table>

    <br><br>

    {{-- =========== MONTHLY REPORT ============ --}}
    <h2>Monthly Report for {{ \Carbon\Carbon::parse($monthlyMonth)->format('F Y') }}</h2>

    <table border="1" cellpadding="5" cellspacing="0">
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
                    <td style="color: {{ $profit >= 0 ? 'green' : 'red' }}">
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
                <th style="color: {{ $monthlyTotalProfit >= 0 ? 'green' : 'red' }}">
                    {{ number_format($monthlyTotalProfit, 2) }}
                </th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
