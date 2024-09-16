<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'brand',
        'model',
        'plate',
    ];

    /**
     * Relação com a tabela de clientes (Client)
     * Um veículo pertence a um Cliente 
     */
    public function cliente(){
        return $this->belongsTo(Client::class);
    }

    /**
     * Relação com a tabela de Ordens de Serviços (Order)
     * Um veículo pode ter várias Ordens de Serviços
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
