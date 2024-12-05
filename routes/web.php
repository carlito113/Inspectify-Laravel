<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/test-pdf', function () {
    $pdf = Pdf::loadHTML('<h1>PDF Test</h1>');
    return $pdf->download('test.pdf');
});
