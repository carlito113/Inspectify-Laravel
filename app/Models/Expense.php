<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $fillable = [ 
        'type_of_expense',  // The name of the expense
        'amount', // The amount of the expense
    ];

    /**
     * The attributes that should be cast to native types.
     */
  
}
