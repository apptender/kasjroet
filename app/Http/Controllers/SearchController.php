<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function show(string $query)
    {
        //@todo save searchquery with ip address and other request data (maybe in middleware)

//        $products = Product::with(['brand', 'categories'])->where('productname', 'like','%'.$query .'%')->get();
        $brand = Brand::where('brandname', '=', $query)->first();
        if ($brand) {
            $products = DB::table('products')
                ->leftjoin('brands', 'brands.id', '=', 'products.brand_id')
                ->orderBy('products.productname')
                ->where('brand_id', '=', $brand->id)->get();
        } else {
            $products = DB::table('products')
                ->leftjoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('products.productname', 'like', '%' . $query . '%')
                ->orWhere('brands.brandname', 'like', '%' . $query . '%')
                ->orderBy('products.productname')
                ->get();
        }

        return response()->json([
            'products' => $products,
        ]);

    }
}
