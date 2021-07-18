@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            <div class="card-header">Update Product</div>
            <div class="card-body card-block">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-check-circle"></i>You Should Fill All Fields
                </div>
                @endif
                <form action="{{url('/update-product')}}" method="post" id="add_product_form">
                    @csrf
                    <input type="hidden" value="{{$products->id}}" name="id">
                    <input type="hidden" value="{{$products->product_id}}" name="product_id">
                    <input type="hidden" value="{{$products->code}}" name="old_code">
                <div class="row form-group">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input type="text" name="name" placeholder="Name" class="form-control" value="{{(old('name'))?? $products->name}}" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Code</label>
                                <input type="text" name="code" placeholder="Code" class="form-control" value="{{(old('code'))?? $products->code}}" required>
                                @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Unit Price</label>
                                <input type="text" name="unit_price" placeholder="Unit Price in SYP" class="form-control" value="{{(old('unit_price'))?? $products->unit_price}}" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-control-label">Sale Price</label>
                                <input type="text" name="sale_price" placeholder="Sale Price in SYP" class="form-control" value="{{(old('sale_price'))?? $products->sale_price}}" required>
                            </div>
                        </div>
                </div>
                <div class="row form-group">
                    <div class="col-4">
                        <label class="form-control-label">Size</label>
                        <input type="text" name="size" placeholder="Size" class="form-control" value="{{(old('size'))?? $products->size}}" required>
                    </div>
                    <div class="col-4">
                        <label class="form-control-label">Color</label>
                        <input type="text" name="color" placeholder="Color" class="form-control" value="{{(old('color'))?? $products->color}}" required>
                    </div>
                    <div class="col-4">
                        <label class="form-control-label">Quantity</label>
                        <input type="text" name="quantity" placeholder="Quantity" class="form-control" value="{{(old('quantity'))?? $products->quantity}}" required>
                    </div>
                </div>
                <div class="form-actions form-group" id="add_product_submit_button"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection