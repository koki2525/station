<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'desired_delivery_date',
        'amount_ulp93',
        'amount_ulp95',
        'amount_diesel',
        'user_id',
    ];
}

