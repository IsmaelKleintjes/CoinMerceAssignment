<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coin_id',
        'price',
        'price_change_percentage_1h',
        'price_change_percentage_24h',
        'price_change_percentage_7d',
        'amount',
    ];
}
