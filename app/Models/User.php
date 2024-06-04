<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'state_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function deviceCosts(): HasMany
    {
        return $this->hasMany(DeviceCost::class);
    }

    public function energyCosts(): HasMany
    {
        return $this->hasMany(EnergyCost::class);
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class);
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
