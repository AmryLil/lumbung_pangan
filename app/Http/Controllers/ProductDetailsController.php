<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function showProductDetails($id)
    {
        return view('product');
    }
}
