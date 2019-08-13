<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public function index(){
        return response()->json(Product::with(['brand', 'categories'])->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'productname' => 'required|unique:products'
        ]);
        $brand = Brand::find($request->brand);
        $product = new Product();
        $product->productname = $request->productname;
        $product->kosher = $request->kosher;
        $product->kosherType = $request->koshertype;
        $product->eancode = $request->eancode;

        if ($request->has('brand_id')) {
            $product->brand_id = $request->brand_id;
        } else {
            $product->brand_id = $brand->id;
        }

        $product->save();

        if ($request->has('categories')) {
            foreach ($request->categories as $category) {
                $product->categories()->attach($category['id']);
            }
        }

        $product->save();
        return response()->json([], JsonResponse::HTTP_CREATED);
    }


}
