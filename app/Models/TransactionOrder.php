<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOrder extends Model
{
    use HasFactory;

    protected $table = 'transaction_orders';

    protected $guarded = [
        'id'
    ];

    public function products(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
