<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\CashBalance;

class CashBalanceService
{
    public function storeCashBalance($request)
    {
        //store cash balance data 
        $endingCash = $request['initial_cash'];
        $change = 0;

        $storeCashBalance = CashBalance::create([
            'initial_cash'   => $request['initial_cash'],
            'ending_cash'    => $request['initial_cash'],
            'change'         => $change,
        ]);

        return $storeCashBalance;
    }

    public function destroyCashBalance($id)
    {   
        //logic to delete cash balance data by id
        $destroyCashBalance = CashBalance::where('id', $id)->delete();

        return true;
    }
}