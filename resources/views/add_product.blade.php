@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            <div class="card-header">Add Product</div>
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
                <a href="javascript:;" style="font-size:30px" id="add_row"><i class="fa fa-plus-square"></i></a>
                <form action="{{url('/add-product')}}" method="post" id="add_product_form">
                    @csrf
                    <input type="hidden" value="0" id="details_index_value">
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{old('name')}}" required>
                    <input type="text" name="code" placeholder="Code" class="form-control" value="{{old('code')}}" required>
                    <input type="text" name="unit_price" placeholder="Unit Price in SYP" class="form-control" value="{{old('unit_price')}}" required>
                    <input type="text" name="sale_price" placeholder="Sale Price in SYP" class="form-control" value="{{old('sale_price')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" name="details[0]['size']" placeholder="Size" class="form-control" required>
                    <input type="text" name="details[0]['color']" placeholder="Color" class="form-control" required>
                    <input type="text" name="details[0]['quantity']" placeholder="Quantity" class="form-control" required>
                    </div>
                </div>
                <div class="form-actions form-group" id="add_product_submit_button"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#add_row').on('click',function(){
            var index = parseInt($("#details_index_value").val()) + 1;
            var row = `<div class="form-group">
                            <div class="input-group">
                            <input type="text" name="details[`+index+`]['size']" placeholder="Size" class="form-control" required>
                            <input type="text" name="details[`+index+`]['color']" placeholder="Color" class="form-control" required>
                            <input type="text" name="details[`+index+`]['quantity']" placeholder="Quantity" class="form-control" required>
                            </div>
                        </div>`;
            
            $("#details_index_value").val(index);
            $("#add_product_submit_button").before(row);
        })
    </script>
@endsection