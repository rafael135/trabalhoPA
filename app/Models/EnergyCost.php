<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnergyCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kw_cost_per_hour',
        'kw_cost',
        'total_kw_consumed',
        'from',
        'to'
    ];

    protected $table = "energy_costs";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
