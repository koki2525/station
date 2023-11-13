<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckTrailer extends Model
{
    use HasFactory;

    protected $table = 'truck_trailers'; // Adjust the table name if needed

    protected $fillable = [
        'comp1',
        'comp2',
        'comp3',
        'comp4',
        'comp5',
        'comp6',
        'comp7',
        // Add other columns as needed
    ];
}
