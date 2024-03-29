<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delaying extends Model
{
    use HasFactory;
    protected $fillable = [
        'credit_id',
        'amount',
        'penalty_amount',
    ];
}
