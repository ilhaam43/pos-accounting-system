<?php

namespace App\Services;

use App\Models\ProductCategory;

class ProductCategoryService
{
    public function store($data)
    {
        $store = ProductCategory::create([
            'category_name' => $data['category_name']
        ]); 

        return $store;
    }

    public function update($data, $id)
    {
        $update = ProductCategory::findOrFail($id)->update([
            'category_name' => $data['category_name']
        ]);

        return $update;
    }

    public function destroy($id)
    {
        $destroy  = ProductCategory::where('id', $id)->delete();

        return $destroy;
    }
}
