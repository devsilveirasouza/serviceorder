<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vehicle_id',
        'user_id',
        'status',
    ];

    /**
     * Relação com a tabela de Clientes (CLient)
     * Uma ordem de serviço pertence a um cliente
     */
    public function client(){
        return $this->belongsTo(Client::class);
    }

    /**
     * Relação com a tabela de Veículos (Vehicle)
     * Uma ordem de serviço pertence a um veículo
     */
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Relação com a tabela de Usuários (User)
     * Uma ordem de serviço é criada por um usuário
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relação com a tabela de itens de ordens de serviço (OrderItem)
     * Uma ordem de serviço pode estar associada a vários itens (peças e serviços)     
     */
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}