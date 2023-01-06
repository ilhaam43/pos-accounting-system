<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Product;

class ProductService
{
    public function storeProduct($request)
    {
        //convert rupiah price input to number again
        $request['price'] = str_replace('Rp. ', '', $request['price']);
        $request['price'] = str_replace('.', '', $request['price']);
        $request['price'] = str_replace(',', '.', $request['price']);
        $request['price'] = intval($request['price']);
        
        $name = $request->file('product_image')->getClientOriginalName();
        $uploadPhoto = $request->product_image->move(public_path('products/image'), $name);
        $request['image'] = 'products/image/' . $name;

        $storeProduct = Product::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'image' => $request['image']
        ]);

        return $storeProduct;
    }

    public function updateAdmin($request, $id)
    {
        $check = empty($request['password']);

        if($check == 0){
            $request['password'] = Hash::make($request['password']);
            $update = User::find($id)->update($request->all());
            return $update;
        }elseif($check == 1){
            $update = User::find($id)->update($request->except(['password', 'confirm_password']));
            return $update;
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