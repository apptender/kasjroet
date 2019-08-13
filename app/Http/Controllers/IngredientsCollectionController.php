<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class IngredientsCollectionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = [];
        /** @var array $ingredients */
        $savedData = collect($request->all())->map(function($item,$key) use($data) {
            try {
                $ingredient = new Ingredient([
                    'name' => $item,
                    'kosher' => false,
                ]);
                $ingredient->save();
            } catch (QueryException $e ){
                return Ingredient::whereName($item)->first();
            }

            return $ingredient->fresh();
        });
        $data['saved'] = $savedData;
        return response()->json($data);
    }
}
