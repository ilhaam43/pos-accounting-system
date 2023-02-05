<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserService
{
    public function storeUser($request)
    {
        //check password and confirm password
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect()->route('owner.users.index')->with('error', 'Password tidak sama dengan konfirmasi password.');
        }

        //store user data 
        $storeAdmin = User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => bcrypt($request['password']),
            'role'      => $request['role']
        ]);

        return $storeAdmin;
    }

    public function updateUser($request, $id)
    {   
        //check password and confirm password

        //update menu data query
        $request['password'] = bcrypt($request['password']);
        $updateUser = User::find($id)->update($request->except(['confirm_password']));
        
        return $updateUser;
    }

    public function destroyUser($id)
    {   
        //logic to delete admin data by id
        $destroyUser = User::where('id', $id)->delete();

        return true;
    }
}