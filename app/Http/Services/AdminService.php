<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AdminService
{
    public function storeAdmin($request)
    {
        //check password and confirm password
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect()->route('owner.admins.index')->with('error', 'Password tidak sama dengan konfirmasi password.');
        }

        //store admin data 
        $storeAdmin = User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => $request['password'],
            'role'      => 'admin'
        ]);

        return $storeAdmin;
    }

    public function updateAdmin($request, $id)
    {   
        //check password and confirm password

        //update menu data query
        $updateAdmin = User::find($id)->update($request->except(['confirm_password']));
        return $updateAdmin;
    }

    public function destroyAdmin($id)
    {   
        //logic to delete admin data by id
        $destroyAdmin = User::where('id', $id)->delete();

        return true;
    }
}