<!DOCTYPE html>
<html>
<head>
    <title>STOCK MANAGEMENT SYSTEM</title>
</head>
<body>
    <div>
{{-- 
        Sidebar (includes @yield) --}}
        <div>
            <h3>Sidebar</h3>
            <ul>
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="">Product</a></li>
                <li><a href="">StockIn</a></li>
                <li><a href="">StockOut</a></li>
                <li><a href="">Report</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>

            {{-- This is where the page content will appear --}}
            <div style="margin-top: 20px;">
                @yield('content')
            </div>
        </div>

    </div>
</body>
</html>
