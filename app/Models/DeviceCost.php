<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DeviceCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'kw_cost_per_hour',
        'kw_cost',
        'from',
        'to'
    ];

    protected $table = "device_costs";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class,"device_id","id");
    }
}
