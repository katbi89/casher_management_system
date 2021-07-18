<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function read()
    {
        // get all customer and send to view page
        $customers = Customer::join('orders', 'customers.id', '=', 'orders.customer_id')
            ->select('customers.*', DB::raw('SUM(orders.cost) as cost'), DB::raw('SUM(orders.cost_after_discount) as cost_after_discount'))->groupBy('customers.id', 'customers.name', 'customers.phone', 'customers.evaluation', 'customers.total_cost')->get();

        // render view
        return view('all_customers', compact('customers'));
    }

    public function special($cost)
    {
        // get special customer and send to view page
        $customers = Customer::select('customers.*', DB::raw('SUM(orders.cost) as cost'), DB::raw('SUM(orders.cost_after_discount) as cost_after_discount'))
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->where('cost', '>=', (int)$cost)
            ->groupBy('customers.id', 'customers.name', 'customers.phone', 'customers.evaluation', 'customers.total_cost')->get();

        // return response
        return response()->json($customers, 200);
    }

    public function delete(Request $request)
    {
        // validate id input
        $validted = $request->validate([
            'id' => 'required',
        ]);

        // delete customer
        Customer::where('id', $request->id)->delete();

        // back after deleted with success message 
        return back()->withSuccess('Customer deleted successfully');
    }
}
