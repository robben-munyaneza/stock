<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>STOCK MANAGEMENT SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background-color: #2c3e50;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .sidebar h3 {
            font-size: 20px;
            margin-bottom: 30px;
            text-align: center;
            border-bottom: 1px solid #555;
            padding-bottom: 10px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3>Stock System</h3>
        <ul>
            <li><a href="{{route('dashboard')}}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{route('products.index')}}"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="{{route('productin.index')}}"><i class="fas fa-arrow-down"></i> Stock In</a></li>
            <li><a href="{{route('productout.index')}}"><i class="fas fa-arrow-up"></i> Stock Out</a></li>
            <li><a href="{{route('reports.index')}}"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
