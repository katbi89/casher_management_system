<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $total_price = 0;
        $cost_after_discount = $total_price;
        $discount = null;

        if (!$request->details) {
            return back()->withError('There is no products to make order');
        } else {

            $validated = $request->validate([
                "name" => 'required',
                "phone" => 'required',
            ]);

            foreach ($request->details as $product) {
                $productDetails = Product::where('code', $product["'code'"])->first();

                $price = $productDetails->sale_price;

                if ($productDetails->price_after_discount) {
                    $price = $productDetails->price_after_discount;
                }

                $total_price += ($price * $product["'quantity'"]);

                $valid_quantity = ProductDetails::where('id', $product["'id'"])->value('quantity');

                if ($valid_quantity >= $product["'quantity'"]) {
                    ProductDetails::where('id', $product["'id'"])->decrement('quantity', $product["'quantity'"]);
                } else {
                    return back()->withError('invalid quantity of product ' . $product["'code'"]);
                }
            }

            $customer = Customer::where('phone', $request->phone)->get();

            if (count($customer) == 0) {
                $customer = Customer::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'evaluation' => 1
                ]);
            } else {
                $customer = $customer[0];
                Customer::where('phone', $request->phone)->increment('evaluation');
            }

            $cost_after_discount = $total_price;
            if ($request->discount) {
                if ($request->type == '%') {
                    $cost_after_discount = $total_price - ($total_price * ($request->discount / 100));
                    $discount = $request->discount . ' ' . $request->type;
                } elseif ($request->type == 'SYP') {
                    $cost_after_discount = $total_price - $request->discount;
                    $discount = $request->discount . ' ' . $request->type;
                }
            }

            $order = Order::create([
                'customer_id' => $customer->id,
                'casher_id' => Auth::id(),
                'cost' => $total_price,
                'discount' => $discount,
                'cost_after_discount' => $cost_after_discount
            ]);

            Customer::where('id',$customer->id)->update([
                'total_cost' => $total_price + $customer->total_cost
            ]);

            foreach ($request->details as $product) {
                $productDetails = Product::where('code', $product["'code'"])->first();

                $price = $productDetails->sale_price;

                if ($productDetails->price_after_discount) {
                    $price = $productDetails->price_after_discount;
                }
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $product["'product_id'"],
                    'details_product_id' => $product["'id'"],
                    'price' => $price,
                    'quantity' => $product["'quantity'"]
                ]);
            }

            return back()->withSuccess('Order created successfully');
        }
    }

    public function read()
    {
        $orders = Order::join('users', 'users.id', '=', 'orders.casher_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('customers.name as customer_name', 'customers.phone', 'users.name as casher_name', 'orders.id', 'orders.cost', 'orders.discount', 'orders.cost_after_discount', 'orders.created_at')
            ->get();

        return view('all_orders', compact('orders'));
    }

    public function readSigle($order_id)
    {
        $order = Order::where('orders.id', $order_id)
            ->join('users', 'users.id', '=', 'orders.casher_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('customers.name as customer_name', 'customers.phone', 'users.name as casher_name', 'orders.id', 'orders.cost', 'orders.discount', 'orders.cost_after_discount', 'orders.created_at')
            ->first();

        $orderDetails = OrderDetails::where('order_id', $order_id)
            ->join('products_details', 'products_details.id', '=', 'order_details.details_product_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->select('products_details.size', 'products_details.color', 'order_details.quantity', 'order_details.details_product_id', 'products.name', 'products.code', 'order_details.price')
            ->get();

        return view('order_details', compact('order', 'orderDetails'));
    }

    public function product_back($product_id, $order_id, $price)
    {
        $order = OrderDetails::where('order_id', $order_id)->get();

        $quantity = OrderDetails::where('order_id', $order_id)->where('details_product_id', $product_id)->value('quantity');

        ProductDetails::where('id', $product_id)->increment('quantity', $quantity);

        if (count($order) > 1) {
            $order = Order::find($order_id);

            $mony_back = $price * $quantity;

            $new_cost = $order->cost - $mony_back;

            $cost_after_discount = $new_cost;
            if ($order->discount) {
                $discount = explode(' ', $order->discount);
                if ($discount[1] == '%') {
                    $cost_after_discount = $new_cost - ($new_cost * ($discount[0] / 100));
                } elseif ($discount[1] == 'SYP') {
                    $cost_after_discount = $new_cost - $discount[0];
                }
            }

            $order->update([
                'cost' => $new_cost,
                'cost_after_discount' => $cost_after_discount
            ]);

            OrderDetails::where('order_id', $order_id)->where('details_product_id', $product_id)->delete();

            return back()->withSuccess('product back successfully and mony back is ' . $mony_back . ' SYP');
        } else {
            $customer_id = Order::where('id', $order_id)->value('customer_id');

            Customer::where('id', $customer_id)->decrement('evaluation');

            Customer::where('evaluation', 0)->delete();

            Order::where('id', $order_id)->delete();

            return redirect('/all-orders')->withSuccess('Order deleted successfully');
        }
    }

    public function delete(Request $request)
    {
        $products = OrderDetails::where('order_id', $request->id)->get();

        foreach ($products as $product) {
            ProductDetails::where('id', $product->details_product_id)->increment('quantity', $product->quantity);
        }

        $order = Order::where('id', $request->id)->first();

        Customer::where('id', $order->customer_id)->decrement('evaluation');

        Customer::where('evaluation', 0)->delete();

        Order::where('id', $request->id)->delete();

        return back()->withSuccess('Order deleted successfully and mony back is ' . $order->cost_after_discount . ' SYP');
    }
}
