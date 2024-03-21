<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Device extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_uuid',
        'consumptionPerHour',
        'brand',
        'name'
    ];

    /**
     * Gera um novo uuid para o Model
     */
    public function newUniqueId(): string
    {
        return (string)Uuid::uuid1();
    }
    
    /**
     * Pega as colunas que devem ter um identificador unico
     * 
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ["uuid"];
    }
}
