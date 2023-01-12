<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\Transaction;
use App\Models\TransactionProduct;
use App\Models\TransactionOrder;

class TransactionService
{
    public function storeOrder($request)
    {
        //store product id to transaction order
        $storeTransactionOrder = TransactionOrder::create([
            'product_id' => $request['product_id'],
        ]);

        return $storeTransactionOrder;
    }

    public function destroyOrder($id)
    {
        $transactionOrderDelete = TransactionOrder::where('id', $id)->delete();

        return $transactionOrderDelete;
    }

    public function updateProduct($request, $id)
    {   
        //check if image uploaded or not
        if($request['product_image']){
            //get image data product to delete old image
            $product = Product::where('id', $id)->first();
            $deletePhotoProduct = unlink($product->image);

            //upload image to folder
            $name = $request->file('product_image')->getClientOriginalName();
            $uploadPhoto = $request->product_image->move(public_path('products/image'), $name);
            $request['image'] = 'products/image/' . $name;

            //update product data queri
            $updateProduct = Product::find($id)->update($request->except(['product_image']));
            return $updateProduct;
        }else{
            //update product data queri
            $updateProduct = Product::find($id)->update($request->except(['product_image']));
            return $updateProduct;
        }
    }

    public function destroyProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $deletePhotoProduct = unlink($product->image);
        $destroyProduct = Product::where('id', $id)->delete();

        return $destroyProduct;
    }
}