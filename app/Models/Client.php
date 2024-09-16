<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * Relação com a tabela de Veículos (Vehicle)
     * Um cliente pode ter vários veículos
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Relação com a tabela de Ordens de Serviços (Order)
     * Um Cliente pode ter várias Ordens de Serviços
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
