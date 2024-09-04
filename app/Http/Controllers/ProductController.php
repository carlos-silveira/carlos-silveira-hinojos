<?php

namespace App\Http\Controllers;

use App\Models\CatalogProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return CatalogProduct::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
        ]);

        $product = CatalogProduct::create($request->all());

        return response()->json($product, 201);
    }

    public function show($id)
    {
        return CatalogProduct::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = CatalogProduct::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'height' => 'sometimes|numeric',
            'length' => 'sometimes|numeric',
            'width' => 'sometimes|numeric',
        ]);

        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = CatalogProduct::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
