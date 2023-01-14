<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $guarded = [
        'id'
    ];

    public function transactionProducts(){
        return $this->hasMany(TransactionProduct::class, 'transaction_id', 'id');
    }

    public function getCreatedAtAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }
}
