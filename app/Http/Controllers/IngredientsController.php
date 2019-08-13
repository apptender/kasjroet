<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Ingredient::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3|unique:ingredients,name',
            'ingredientcode' => 'unique:ingredients,ingredientcode'

        ]);

        (new Ingredient([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'ingredientcode' => $request->get('ingredientcode'),
            'koshertype' => $request->get('koshertype'),
            'kosher' => $request->has('kosher'),
        ]))->save();

        return response()->json([], JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Ingredient $ingredient)
    {
        return response()->json(['data' => $ingredient]);
    }


    /**
     * @param Ingredient $ingredient
     * @return Factory|View
     */
    public function edit(Ingredient $ingredient)
    {
        return response()->json($ingredient, JsonResponse::HTTP_OK);
    }


    /**
     * @param Request $request
     * @param Ingredient $ingredient
     * @return JsonResponse
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $ingredient->update($request->all());
        return response()->json([], JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
