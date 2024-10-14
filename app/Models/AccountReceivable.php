<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountReceivable extends Model
{
    protected $table = 'accounts_receivable';

    use HasFactory;

    protected $fillable = ['description', 'amount', 'due_date', 'status'];

    public function installments()
    {
        return $this->hashMany(Installment::class);
    }
}
