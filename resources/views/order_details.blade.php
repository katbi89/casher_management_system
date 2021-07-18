@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-header">Update Product</div>
            <div class="card-body card-block">
                <div class="row form-group">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Order ID</label>
                                <input type="text" class="form-control" value="{{$order->id}}" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Customer Name</label>
                                <input type="text" class="form-control" value="{{$order->customer_name}}" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Phone</label>
                                <input type="text" class="form-control" value="{{$order->phone}}" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Casher Name</label>
                                <input type="text" class="form-control" value="{{$order->casher_name}}" disabled>
                            </div>
                        </div>
                </div>
                <div class="row form-group">
                    <div class="col-4">
                        <label class="form-control-label">Cost</label>
                        <input type="text" class="form-control" value="{{$order->cost}}" disabled>
                    </div>
                    <div class="col-4">
                        <label class="form-control-label">Discount</label>
                        <input type="text" class="form-control" value="{{$order->discount}}" disabled>
                    </div>
                    <div class="col-4">
                        <label class="form-control-label">Cost After Discount</label>
                        <input type="text" class="form-control" value="{{($order->cost_after_discount == $order->cost)? "":$order->cost_after_discount}}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
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
                <th>Name</th>
                <th>Code</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Product Back</th>
              </tr>
            </thead>
            <tbody>
                @if ($orderDetails)
                    @foreach ($orderDetails as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->code}}</td>
                        <td>{{$product->size}}</td>
                        <td>{{$product->color}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td class="d-flex justify-content-center"><a href="/product-back/{{$product->details_product_id}}/{{$order->id}}/{{$product->price}}" style="font-size:20px;color:red;margin:10px" onclick="return confirm('Do You Want To Back Product?')"><i class="fa fa-minus-square"></i></a></td>
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