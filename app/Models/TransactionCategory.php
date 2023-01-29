<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    use HasFactory;

    protected $table = 'transaction_categories';

    protected $guarded = [
        'id'
    ];

    public function income(){
        return $this->belongsTo(Income::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
