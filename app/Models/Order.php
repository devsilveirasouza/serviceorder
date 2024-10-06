<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'total_price',
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
     * Relacionamento com os serviços da ordem
     */
    public function services()
    {
        return $this->hasMany(OrderService::class);
    }

    /**
     * Relacionamento com as peças da ordem
     */
    public function parts()
    {
        return $this->hasMany(OrderPart::class);
    }
    
}