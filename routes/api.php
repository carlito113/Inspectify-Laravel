<?php

use App\Http\Controllers\RevenueController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfitLossController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::resource('inspectify_laravel', RevenueController::class);


// Route::get('/view', [RevenueController::class, "view"]);
// Route::post('/create', [RevenueController::class, "create"]);

Route::resource('Revenue', RevenueController::class); //get or display data

Route::resource('products', RevenueController::class); //post or add data

Route::get('/revenue/total', [RevenueController::class, "addRevenue"]); //this is computation on total revenue
Route::get('/sales/total', [RevenueController::class, "addSale"]); //this is computation on total sales


Route::resource('edit', RevenueController::class); //edit
 
Route::get('weekly', [RevenueController::class, "weeklyRevenues"]); //edit
 

Route::get('/expenses', [ExpenseController::class, 'index']);

Route::post('/add-expense', [ExpenseController::class, "store"]);

Route::put('/edit-expense/{id}', [ExpenseController::class, "update"]);

Route::get('/expense/total', [ExpenseController::class, "totalExpense"]);

Route::get('weekly-expense', [ExpenseController::class, "weeklyExpense"]);

Route::get('profitloss', [ProfitLossController::class,"weeklyProfitLoss"]);

Route::delete('deleteRevenue/{id}', [RevenueController::class, "destroy"]);

Route::delete('deleteExpense/{id}', [ExpenseController::class, "destroy"]);

