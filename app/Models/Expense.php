<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    protected $guarded = [
        'id'
    ];

    public function TransactionCategory(){
        return $this->hasOne(TransactionCategory::class, 'id', 'category_id');
    }
}
