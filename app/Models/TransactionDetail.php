<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'total', 'qty', 'product_id'];
    public function transaction()
    {
        $this->belongsTo(Transaction::class);
    }
}
