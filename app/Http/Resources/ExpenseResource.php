<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'date' => $this->date->format('Y-m-d'), // Ensure a consistent date format
    //         'type_of_expense' => $this->type_of_expense,
    //         'amount' => $this->amount,
    //         'created_at' => $this->created_at->toDateTimeString(),
    //         'updated_at' => $this->updated_at->toDateTimeString(),
    //     ];
    // }
}
