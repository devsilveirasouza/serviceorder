<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'part_id',
        'service_id',
        'quantity',
        'price',
    ];

    /**
     * Relação com a tabela de Ordens de Serviços (Order)
     * Um item de ordem de serviço pode estar associado a uma ordem de serviço
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relação com a tabela de pecas (Part)
     * Um item de ordem de serviço pode estar associado a uma peca
     */
    public function part(){
        return $this->belongsTo(Part::class);
    }

    /**
     * Relação com a tabela de Serviços (Service)
     * Um item de ordem de serviço pode estar associado a um Serviço
     */
    public function service(){
        return $this->belongsTo(Service::class);
    }
}