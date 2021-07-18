@extends('layouts.main')

@section('content')
<div class="content mt-3">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            <i class="fas fa-check-circle"></i> {{ Session::get('error') }}
        </div>
    @endif
    <div class="animated fadeIn">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Table</strong>
                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Casher Name</th>
                <th>Cost</th>
                <th>Discount</th>
                <th>Cost After Discount</th>
                <th>Order Date & Time</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if ($orders)
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->customer_name}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->casher_name}}</td>
                        <td>{{$order->cost}}</td>
                        <td>{{$order->discount}}</td>
                        <td>{{($order->cost_after_discount == $order->cost)? "":$order->cost_after_discount}}</td>
                        <td>{{$order->created_at}}</td>
                        <td class="d-flex">
                            <form action="{{url('/delete-order')}}" method="post">
                                @csrf
                                    <input type="hidden" value="{{$order->id}}" name="id"/>
                                    <button type="submit" style="border:none;background:none" onclick="return confirm('Do You Want To Delete This User?');">
                                        <span class="ti-trash" style="color:red;font-size:30px"></span><span class="icon-name"></span>
                                    </button>
                            </form>
                            <a href="/order-details/{{$order->id}}" class="text-center">Order Details</a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
                </div>
            </div>
        </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection