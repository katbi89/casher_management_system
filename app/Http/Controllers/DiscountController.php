<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function read()
    {
        // read all discounts
        $discounts = Product::whereNotNull('discount')->get();

        // render view with result
        return view('all_discounts', compact('discounts'));
    }

    public function delete(Request $request)
    {
        // validate id input
        $validated = $request->validate([
            'id' => 'required',
        ]);

        // remove discount value from product
        Product::where('id', $request->id)->update([
            'discount' => null,
            'price_after_discount' => null,
        ]);

        // back after discount removed with success message
        return back()->withSuccess('Discount Deleted Successfully');
    }

    public function product(Request $request)
    {
        // validate input
        $validated = $request->validate([
            'code' => 'required',
            'discount' => 'required',
            'type' => 'required',
        ]);

        // get price of product
        $price = Product::where('code', $request->code)->value('sale_price');

        if ($price) {
            // check type of discount (ratio or money) and make the discount
            if ($request->type == 'SYP') {
                $price_after_discount = $price - $request->discount;
            } elseif ($request->type == '%') {
                $price_after_discount = $price - ($price * ($request->discount / 100));
            }

            // update product price after discount
            Product::where('code', $request->code)->update([
                'discount' => $request->discount . ' ' . $request->type,
                'price_after_discount' => $price_after_discount,
            ]);

            // back with success message
            return back()->withSuccess('Discount Maked Successfully');
        } else {
            // if product not found back with error
            return back()->withError('Product Code Not Found');
        }
    }
}
