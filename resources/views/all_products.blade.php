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
                <th>Name</th>
                <th>Code</th>
                <th>Unit Price</th>
                <th>Sale Price</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Price After Discount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @if ($products)
                    @foreach ($products as $products)
                    <tr>
                        <td>{{$products->name}}</td>
                        <td>{{$products->code}}</td>
                        <td>{{$products->unit_price}}</td>
                        <td>{{$products->sale_price}}</td>
                        <td>{{$products->size}}</td>
                        <td>{{$products->color}}</td>
                        <td>{{$products->quantity}}</td>
                        <td>{{$products->discount}}</td>
                        <td>{{$products->price_after_discount}}</td>
                        <td class="d-flex">
                            <form action="{{url('/delete-product')}}" method="post">
                                @csrf
                                    <input type="hidden" value="{{$products->id}}" name="id"/>
                                    <input type="hidden" value="{{$products->product_id}}" name="product_id"/>
                                    <button type="submit" style="border:none;background:none" onclick="return confirm('Do You Want To Delete This User?');">
                                        <span class="ti-trash" style="color:red;font-size:30px"></span>
                                    </button>
                            </form>
                            <a href="/update-product/{{$products->id}}/{{$products->product_id}}" style="border:none;background:none"><i class="fa fa-edit" style="color:green;font-size:30px"></i></a>
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