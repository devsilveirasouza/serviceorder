<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity_in_stock',
    ];

    /**
     * Relação com a tabela de peças de ordens de serviço (OrderParts)
     * Uma peça pode estar associada a vários itens de ordens de serviço
     */
    public function orders(){
        return $this->hasMany(OrderPart::class);
    }
}
