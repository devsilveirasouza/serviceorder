<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * Relação com a tabela de itens de ordens de serviço (OrderItem)
     * Um serviço pode estar associado a vários itens de ordens de serviço
     */
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
