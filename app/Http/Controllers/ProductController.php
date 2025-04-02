<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends BaseController
{
    public function list()
    {
        $products = Product::all();
        return $this->sendSuccessResponse($products, 'Product list retrieved successfully', Response::HTTP_OK);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendErrorResponse('Product not found', Response::HTTP_NOT_FOUND);
        }

        return $this->sendSuccessResponse($product, 'Product retrieved successfully', Response::HTTP_OK);
    }
}
