<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransactionOrder extends Model
{
    use HasFactory;

    protected $table = 'sales_transaction_orders';

    protected $guarded = [
        'id'
    ];

    public function menu(){
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
}
