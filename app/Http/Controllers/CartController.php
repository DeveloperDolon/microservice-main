<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function add()
    {
        return $this->sendSuccessResponse([], 'Item added to cart successfully');
    }
}
