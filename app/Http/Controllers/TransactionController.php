<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin/transaction');
    }
}
