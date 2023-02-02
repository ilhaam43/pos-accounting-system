<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBalance extends Model
{
    use HasFactory;

    protected $table = 'cash_balances';

    protected $guarded = [
        'id'
    ];

    public function getCreatedAtAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }
}
