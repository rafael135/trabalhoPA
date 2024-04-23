<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kw_cost_per_hour',
        'kw_cost',
        'from',
        'to'
    ];

    protected $table = "energy_costs";
}
