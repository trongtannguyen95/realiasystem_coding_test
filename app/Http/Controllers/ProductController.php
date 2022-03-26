<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'sku' => 'required|unique:products',
            'unit' => 'required',
        ]);
        $data = $request->all();
        $product = Product::create($data);
        if (!$product) {
            return response([
                'message' => ['Something is wrong.']
            ], 500);
        }
        $response = [
            'product' => $product,
        ];
        return response($response, 201);
    }
    public function update(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'sku' => 'required',
            'unit' => 'required',
        ]);
        $sku = $request->sku;
        $data = $request->except('sku');
        $product = Product::where('sku', $sku)->update($data);
        if (!$product) {
            return response([
                'message' => ['Something is wrong.']
            ], 500);
        }
        $response = [
            'product' => $product,
        ];
        return response($response, 200);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'sku' => 'required',
        ]);
        $sku = $request->sku;
        $product = Product::where('sku', $sku)->delete();
        if (!$product) {
            return response([
                'message' => ['Something is wrong.']
            ], 500);
        }
        $response = [
            'message' => `deleted product #${$sku}`,

        ];
        return response($response, 201);
    }
}