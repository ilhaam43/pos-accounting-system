<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\Expense;

class ExpenseService
{
    public function storeExpense($request)
    {
        //store expense data 
        $storeExpense = Expense::create([
            'category_id'   => $request['category_id'],
            'description'   => $request['description'],
            'value'         => $request['value'],
        ]);

        return $storeExpense;
    }

    public function destroyExpense($id)
    {   
        //logic to delete expense data by id
        $destroyExpense = Expense::where('id', $id)->delete();

        return true;
    }
}