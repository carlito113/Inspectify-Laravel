<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Revenue;

class PdfController extends Controller
{
    public function downloadPdf()
    {
        $revenues = Revenue::all();
        
        // Ensure 'pdf-template' exists in resources/views
        $pdf = Pdf::loadView('pdf-template', ['revenues' => $revenues]);
        
        // Use the appropriate response type
        return $pdf->download('Revenue.pdf');
    }
}
