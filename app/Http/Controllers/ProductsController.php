<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products',
            'unit_price' => 'required',
            'sale_price' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'unit_price' => $request->unit_price,
            'sale_price' => $request->sale_price,
        ]);

        $product_id = Product::where('code', $request->code)->value('id');

        foreach ($request->details as $data) {
            ProductDetails::create([
                'product_id' => $product_id,
                'size' => $data["'size'"],
                'color' => $data["'color'"],
                'quantity' => $data["'quantity'"],
            ]);
        }

        return back()->withSuccess('Product Created Successfully');
    }

    public function addDetails(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
        ]);

        $product_id = Product::where('code', $request->code)->value('id');

        if (!is_null($product_id)) {
            foreach ($request->details as $data) {
                ProductDetails::create([
                    'product_id' => $product_id,
                    'size' => $data["'size'"],
                    'color' => $data["'color'"],
                    'quantity' => $data["'quantity'"],
                ]);
            }

            return back()->withSuccess('Details Created Successfully');
        } else {
            return back()->withError('Product Code Not Found');
        }
    }

    public function read()
    {
        $products = Product::join('products_details', 'products.id', '=', 'products_details.product_id')
            ->select('products.name', 'products.code', 'products.unit_price', 'products.sale_price', 'products.discount', 'products.price_after_discount', 'products_details.id', 'products_details.product_id', 'products_details.size', 'products_details.color', 'products_details.quantity')->get();

        return view('all_products', compact('products'));
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'product_id' => 'required',
        ]);

        $products = ProductDetails::where('product_id', $request->product_id)->get();
        $numberOfProducts = $products->count();

        if ($numberOfProducts == 1) {
            Product::where('id', $request->product_id)->delete();
        } elseif ($numberOfProducts > 1) {
            ProductDetails::where('id', $request->id)->delete();
        } else {
            return back()->withError('Product not found');
        }

        return back()->withSuccess('Product Deleted Successfully');
    }

    public function readSingle($id, $product_id)
    {
        $products = ProductDetails::where('products_details.id', $id)->join('products', 'products.id', '=', 'products_details.product_id')
            ->select('products.name', 'products.code', 'products.unit_price', 'products.sale_price', 'products_details.id', 'products_details.product_id', 'products_details.size', 'products_details.color', 'products_details.quantity')->get()[0];

        return view('update_product', compact('products'));
    }

    public function update(Request $request)
    {
        $unique = ($request->code == $request->old_code) ? "" : "unique:products";

        $validated = $request->validate([
            'code' => 'required|' . $unique,
            'name' => 'required',
            'unit_price' => 'required',
            'sale_price' => 'required',
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required',
        ]);

        Product::where('id', $request->product_id)->update([
            'name' => $request->name,
            'code' => $request->code,
            'unit_price' => $request->unit_price,
            'sale_price' => $request->sale_price,
        ]);

        ProductDetails::where('id', $request->id)->update([
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
        ]);

        return redirect('/all-products')->withSuccess('Product Updated Successfully');
    }

    public function out_of_stock($quantity)
    {
        $products = ProductDetails::where('quantity', '<=', (int)$quantity)->join('products', 'products.id', '=', 'products_details.product_id')
            ->select('products.name', 'products.code', 'products_details.size', 'products_details.color', 'products_details.quantity')->get();

        return response()->json($products, 200);
    }
}
