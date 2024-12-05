<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfModel extends Model
{
    protected $fillable = [
        "product",
        "quantity",
        "amount" 
       ];
}
