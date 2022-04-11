<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store($data)
    {
        $store = Product::create([
            'product_category_id' => $data['product_category_id'],
            'product_code' => $data['product_code'],
            'product_name' => $data['product_name'],
            'buy_price' => $data['buy_price'],
            'sell_price' => $data['sell_price'],
            'discount' => $data['discount'],
        ]); 

        return $store;
    }

    public function update($data, $id)
    {
        $update = Product::findOrFail($id)->update([
            'product_category_id' => $data['product_category_id'],
            'product_code' => $data['product_code'],
            'product_name' => $data['product_name'],
            'buy_price' => $data['buy_price'],
            'sell_price' => $data['sell_price'],
            'discount' => $data['discount']
        ]);

        return $update;
    }

    public function destroy($id)
    {
        $destroy  = Product::where('id', $id)->delete();

        return $destroy;
    }
}
