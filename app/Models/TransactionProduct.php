<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{
    use HasFactory;

    protected $table = 'transaction_products';

    protected $guarded = [
        'id'
    ];

    public function transactions(){
        return $this->belongsTo(Transactions::class);
    }
}
