<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Get the date from the request or use today
        $dailyDate = request('date') ?? now()->toDateString();
        $monthlyMonth = request('month') ?? now()->format('Y-m');

        // Load daily report with eager loading and filtering
        $dailyProducts = Product::with([
            'productins' => fn($q) => $q->whereDate('productin_date', $dailyDate),
            'productouts' => fn($q) => $q->whereDate('productout_date', $dailyDate),
        ])->get();

        // Load monthly report with eager loading and filtering
        $monthlyProducts = Product::with([
            'productins' => fn($q) => $q->whereMonth('productin_date', Carbon::parse($monthlyMonth)->month),
            'productouts' => fn($q) => $q->whereMonth('productout_date', Carbon::parse($monthlyMonth)->month),
        ])->get();

        return view('pages.reports.report', [
            'dailyDate' => $dailyDate,
            'monthlyMonth' => $monthlyMonth,
            'dailyProducts' => $dailyProducts,
            'monthlyProducts' => $monthlyProducts,
        ]);
    }
}