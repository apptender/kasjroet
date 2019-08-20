<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function show(string $query)
    {
        Log::info($query);
        //@todo save searchquery with ip address and other request data (maybe in middleware)

        $products = Product::with(['brand', 'categories'])->where('productname', 'like','%'.$query .'%')->get();
        return response()->json([
            'products' => $products,
        ]);

    }
}
