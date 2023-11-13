<?php

// app/Models/Station.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'ulp93_capacity',
        'ulp95_capacity',
        'diesel_capacity',
        'ulp93_demand',
        'ulp95_demand',
        'diesel_demand',
        'ulp93_stock',
        'ulp95_stock',
        'diesel_stock',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

