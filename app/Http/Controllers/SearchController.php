<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function show(string $query)
    {
        //@todo save searchquery with ip address and other request data (maybe in middleware)

//        $products = Product::with(['brand', 'categories'])->where('productname', 'like','%'.$query .'%')->get();

        $products = DB::table('products')
            ->leftjoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('products.productname', 'like', '%'.$query .'%')
            ->orWhere('brands.brandname', 'like', '%'.$query .'%')
            ->orderBy('products.productname')
            ->get();

        return response()->json([
            'products' => $products,
        ]);

    }
}
