<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\Income;

class IncomeService
{
    public function storeIncome($request)
    {
        //store income data 
        $storeIncome = Income::create([
            'category_id'   => $request['category_id'],
            'description'   => $request['description'],
            'value'         => $request['value'],
        ]);

        return $storeIncome;
    }

    public function destroyIncome($id)
    {   
        //logic to delete income data by id
        $destroyIncome = Income::where('id', $id)->delete();

        return true;
    }
}