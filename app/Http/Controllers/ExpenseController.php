<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Resources\ExpenseResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        // Fetch all sales and return them as Resource
        // return ExpenseResource::collection(Expense::all());
        $expense = Expense::all()->toArray();
        return $expense;
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        Expense::create([
            "type_of_expense" => $request->type_of_expense,
            "amount" => $request->amount
        ]);
    }
    
    // Display specified resource
    public function show(Expense $expense)
    {
        // Return a single sale as a resource
        return new ExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense, $id)
    {
        $expense = Expense::find($id);
        $expense -> update([
            "type_of_expense" => $request->type_of_expense,
            "amount" => $request->amount
        ]);
    }

    public function totalExpense()
    {
        $totalAmount = Expense::sum('amount');
        return $totalAmount;
    }

    public function weeklyExpense()
    {
        $weeklyExpense = DB::table('expenses')
            ->selectRaw('YEARWEEK(created_at, 1) as week, SUM(amount) as total_expense')
            ->groupBy('week')
            ->orderBy('week', 'desc')
            ->get()
            ->map(function ($item) {
                $weekStartDate = Carbon::now()->setISODate(substr($item->week, 0, 4), substr($item->week, 4, 2))->startOfWeek();
                $weekEndDate = $weekStartDate->copy()->endOfWeek();
                $item->formatted_week = $weekStartDate->format('M d') . ' - ' . $weekEndDate->format('M d, Y');
                return $item;
            });
        return response()->json($weeklyExpense);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        // Delete the expense record
        $expense->delete();

        // Return a success response
        return response()->json(['message' => 'Expense deleted successfully'], 200);
    }

}
