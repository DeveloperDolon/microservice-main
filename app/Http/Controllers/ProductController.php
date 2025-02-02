<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return response()->json($products, Response::HTTP_OK);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $product->update($request->all());
        return response()->json($product, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $product->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
