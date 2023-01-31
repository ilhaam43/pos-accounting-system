<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $guarded = [
        'id'
    ];

    public function transactionCategory(){
        return $this->hasOne(TransactionCategory::class, 'id', 'category_id');
    }

    public function getCreatedAtAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }
}
