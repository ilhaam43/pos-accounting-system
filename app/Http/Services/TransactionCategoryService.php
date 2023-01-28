<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\TransactionCategory;

class TransactionCategoryService
{
    public function storeTransactionCategory($request)
    {
        //store transaction category data 
        $storeTransactionCategory = TransactionCategory::create([
            'category'  => $request['category'],
            'type'      => $request['type'],
        ]);

        return $storeTransactionCategory;
    }

    public function destroyTransactionCategory($id)
    {   
        //logic to delete admin data by id
        $destroyTransactionCategory = TransactionCategory::where('id', $id)->delete();

        return true;
    }
}