<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get all products
        $products = Product::join('products_details', 'products.id', '=', 'products_details.product_id')
            ->select('products.name', 'products.code', 'products.sale_price', 'products.discount', 'products.price_after_discount', 'products_details.id', 'products_details.product_id', 'products_details.size', 'products_details.color', 'products_details.quantity')->get();

        // render view with products details
        return view('welcome', compact('products'));
    }
}
