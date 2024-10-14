<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'due_date', 'account_payable_id', 'account_receivable_id'];

    public function accountPayable()
    {
        return $this->belongsTo(AccountPayable::class);
    }

    public function accountReceivable()
    {
        return $this->belongsTo(AccountReceivable::class);
    }
}