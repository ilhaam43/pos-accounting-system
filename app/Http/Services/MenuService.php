<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\Menu;

class MenuService
{
    public function storeMenu($request)
    {
        //convert rupiah price input to number again
        $request['price'] = str_replace('Rp. ', '', $request['price']);
        $request['price'] = str_replace('.', '', $request['price']);
        $request['price'] = str_replace(',', '.', $request['price']);
        $request['price'] = intval($request['price']);
        
        //logic to uplod photo menu
        $name = $request->file('menu_image')->getClientOriginalName();
        $uploadPhoto = $request->menu_image->move(public_path('menus/image'), $name);
        $request['image'] = 'menus/image/' . $name;

        //store menu data
        $storeMenu = Menu::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'image' => $request['image']
        ]);

        return $storeMenu;
    }

    public function updateMenu($request, $id)
    {   
        //check if image uploaded or not
        if($request['menu_image']){
            //get image data menu to delete old image
            $menu = Menu::where('id', $id)->first();
            $deletePhotoMenu = unlink($menu->image);

            //upload image to folder
            $name = $request->file('menu_image')->getClientOriginalName();
            $uploadPhoto = $request->menu_image->move(public_path('menus/image'), $name);
            $request['image'] = 'menus/image/' . $name;

            //update menu data query
            $updateMenu = Menu::find($id)->update($request->except(['menu_image']));
            return $updateMenu;
        }else{
            //update menu data query
            $updateMenu = Menu::find($id)->update($request->except(['menu_image']));
            return $updateMenu;
        }
    }

    public function destroyMenu($id)
    {   
        //logic to get menu by id to destroy
        $menu = Menu::where('id', $id)->first();
        //logic to delete photo menu by id
        $deletePhotoMenu = unlink($menu->image);
        //logic to delete menu data by id
        $destroyMenu = Menu::where('id', $id)->delete();

        return $destroyMenu;
    }
}