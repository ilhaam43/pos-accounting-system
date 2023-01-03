<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProductService
{
    public function storeProduct($request)
    {
        $storeProduct = Product::create([
            'name' => $request['name']
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

    public function destroyAdmin($id)
    {
        $admin = User::where('id', $id)->first();

        $destroyAdmin = Admin::where('id',$admin->userable_id)->delete();
        $destroyUser  = User::where('id', $id)->delete();

        return $destroyUser;
    }
}