<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consumption_per_hour',
        'hours_per_day',
        'brand',
        'name'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gera um novo uuid para o Model
     */
    /* public function newUniqueId(): string
    {
        return (string)Uuid::uuid1();
    } */
    
    /**
     * Pega as colunas que devem ter um identificador unico
     * 
     * @return array<int, string>
     */
    /* public function uniqueIds(): array
    {
        return ["uuid"];
    } */
}
