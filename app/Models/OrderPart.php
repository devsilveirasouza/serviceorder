<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPart extends Model
{
    use HasFactory;

    protected $table = 'order_parts';

    protected $fillable = [
        'order_id',
        'part_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    // Relacionamento com a tabela orders
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relacionamento com a tabela parts
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
