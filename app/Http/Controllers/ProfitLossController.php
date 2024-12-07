<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ProfitLossController extends Controller
{
    public function weeklyProfitLoss()
{
    // Get weekly revenues
    $weeklyRevenues = DB::table('revenues')
        ->selectRaw('YEARWEEK(created_at, 1) as week, SUM(amount) as total_amount')
        ->groupBy('week')
        ->orderBy('week', 'desc')
        ->get()
        ->keyBy('week'); // Key by week for easy merging

    // Get weekly expenses
    $weeklyExpenses = DB::table('expenses')
        ->selectRaw('YEARWEEK(created_at, 1) as week, SUM(amount) as total_expense')
        ->groupBy('week')
        ->orderBy('week', 'desc')
        ->get()
        ->keyBy('week'); // Key by week for easy merging

    // Calculate profit/loss by week
    $weeklyProfitLoss = $weeklyRevenues->map(function ($revenue) use ($weeklyExpenses) {
        $week = $revenue->week;
        $totalExpense = $weeklyExpenses->has($week) ? $weeklyExpenses[$week]->total_expense : 0;

        // Calculate profit and loss
        $profit = $revenue->total_amount - $totalExpense;
        $loss = $profit < 0 ? abs($profit) : 0;

        // Format week range
        $weekStartDate = Carbon::now()->setISODate(substr($week, 0, 4), substr($week, 4, 2))->startOfWeek();
        $weekEndDate = $weekStartDate->copy()->endOfWeek();

        return (object) [
            'week' => $week,
            'formatted_week' => $weekStartDate->format('M d') . ' - ' . $weekEndDate->format('M d, Y'),
            'total_revenue' => $revenue->total_amount,
            'total_expense' => $totalExpense,
            'profit' => $profit > 0 ? $profit : 0,
            'loss' => $loss,
        ];
    });

    return response()->json($weeklyProfitLoss->values()); // Return as JSON array
}

}
