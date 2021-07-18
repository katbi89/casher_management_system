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
                <th>Phone</th>
                <th>Evaluation</th>
                <th>Orders Cost</th>
                <th>Orders Cost After Discount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @if ($customers)
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->evaluation}}</td>
                        <td>{{$customer->cost}}</td>
                        <td>{{$customer->cost_after_discount}}</td>
                        <td class="d-flex">
                            <form action="{{url('/delete-customer')}}" method="post">
                                @csrf
                                    <input type="hidden" value="{{$customer->id}}" name="id"/>
                                    <button type="submit" style="border:none;background:none" onclick="return confirm('Do You Want To Delete This User?');">
                                        <span class="ti-trash" style="color:red;font-size:30px"></span><span class="icon-name"></span>
                                    </button>
                            </form>
                            <a href="https://wa.me/+2{{$customer->phone}}" style="color:green;font-weight:bold;text-align:center">Send Whatsapp Message</a>
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