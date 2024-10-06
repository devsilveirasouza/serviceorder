<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $table = 'order_services';

    protected $fillable = [
        'order_id',
        'service_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    // Relacionamento com a tabela orders
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relacionamento com a tabela services
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
