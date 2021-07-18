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
                <th>Discount</th>
                <th>Price After Discount</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
                @if ($discounts)
                    @foreach ($discounts as $discount)
                    <tr>
                        <td>{{$discount->name}}</td>
                        <td>{{$discount->code}}</td>
                        <td>{{$discount->unit_price}}</td>
                        <td>{{$discount->sale_price}}</td>
                        <td>{{$discount->discount}}</td>
                        <td>{{$discount->price_after_discount}}</td>
                        <td>
                            <form action="{{url('/delete-discount')}}" method="post">
                                @csrf
                                    <input type="hidden" value="{{$discount->id}}" name="id"/>
                                    <button type="submit" style="border:none;background:none" onclick="return confirm('Do You Want To Delete This User?');">
                                        <span class="ti-trash" style="color:red;font-size:30px"></span><span class="icon-name"></span>
                                    </button>
                            </form>
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