<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OwnerController extends Controller
{
    public function index()
    {
        return view('owner/index');
    }
}
