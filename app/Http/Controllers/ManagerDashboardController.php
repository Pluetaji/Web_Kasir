<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\View\View;

class ManagerDashboardController extends Controller
{
    /**
     * Display the manager dashboard with dynamic operational metrics and revenue chart data.
     */
    public function index(): View
    {
        $todayRevenue = Transaction::whereDate('created_at', today())->sum('total_price');
        $todayOrders = Transaction::whereDate('created_at', today())->count();

        // Calculate daily revenue for current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Fetch transactions for current month
        $transactionsThisMonth = Transaction::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get(['total_price', 'created_at']);

        // Group revenue by day of month (1 to daysInMonth)
        $groupedRevenueByDay = $transactionsThisMonth->groupBy(function ($item) {
            return (int) $item->created_at->format('j');
        })->map(function ($items) {
            return $items->sum('total_price');
        });

        $daysInMonth = Carbon::now()->daysInMonth;
        $chartLabels = [];
        $chartData = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $chartLabels[] = "Tgl {$day}";
            $chartData[] = (int) ($groupedRevenueByDay->get($day) ?? 0);
        }

        $currentMonthName = Carbon::now()->locale('id')->translatedFormat('F Y');

        return view('dashboardmanajer', compact(
            'todayRevenue',
            'todayOrders',
            'chartLabels',
            'chartData',
            'currentMonthName'
        ));
    }
}
