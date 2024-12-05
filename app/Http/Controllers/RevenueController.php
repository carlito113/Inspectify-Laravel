<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\PdfModel;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revenue = Revenue::all()->toArray();
        return $revenue;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Revenue::create([
            "product" => $request->product,
            "quantity" => $request->quantity,
            "amount" => $request->amount
        ]);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue, Request $request, $id)
    {
        $revenue = Revenue::find($id);
        $revenue -> edit([
            "product" => $request->product,
            "quantity" => $request->quantity,
            "amount" => $request->amount
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revenue $revenue, $id)
    {
        $revenue = Revenue::find($id);
        $revenue -> update([
            "product" => $request->product,
            "quantity" => $request->quantity,
            "amount" => $request->amount
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        //
    }

        
    public function downloadPdf()

    {
        $revenues = Revenue::all()->toArray();
        $pdf = PdfModel::loadView('pdf-template', $revenues);
        return $pdf->download('Revenue.pdf');
        
    }

    public function addRevenue()
    {
        $totalAmount = Revenue::sum('amount');
        return $totalAmount;
    }
    public function addSale()
    {
        $totalSale = Revenue::sum('quantity');
        return $totalSale;
    }

    public function weeklyRevenues()
    {
        $weeklyRevenues = DB::table('revenues')
            ->selectRaw('YEARWEEK(created_at, 1) as week, SUM(amount) as total_amount')
            ->groupBy('week')
            ->orderBy('week', 'desc')
            ->get()
            ->map(function ($item) {
                $weekStartDate = Carbon::now()->setISODate(substr($item->week, 0, 4), substr($item->week, 4, 2))->startOfWeek();
                $weekEndDate = $weekStartDate->copy()->endOfWeek();
                $item->formatted_week = $weekStartDate->format('M d') . ' - ' . $weekEndDate->format('M d, Y');
                return $item;
            });
        return response()->json($weeklyRevenues);
    }


}
