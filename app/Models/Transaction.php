<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['total', 'customer_id', 'status_transaction', 'pay', 'kembalian'];
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id')->withTrashed();
    }
}
