<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'sales_transaction_details';

    protected $guarded = [
        'id'
    ];

    public function salesTransactions(){
        return $this->belongsTo(SalesTransactions::class);
    }
}
