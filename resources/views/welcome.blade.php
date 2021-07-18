@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            <div class="card-header">Make Order</div>
            <div class="card-body card-block">
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-check-circle"></i>You Should Fill All Fields
                </div>
                @endif
                <form action="{{url('/create-order')}}" method="post" id="add_product_form">
                    @csrf
                    <input type="hidden" value="-1" id="details_index_value">
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{old('name')}}" required>
                    <input type="text" name="phone" placeholder="Phone Number" class="form-control" value="{{old('phone')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" id="total_price" name="total_price" placeholder="Total Price" class="form-control" disabled>
                    <input type="text" id="discount" name="discount" placeholder="Discount" class="form-control">
                    <select name="type" id="select" class="form-control">
                        <option value="0">Please Select</option>
                        <option value="%" {{(old('type') == '%')? "selected":""}}>%</option>
                        <option value="SYP" {{(old('type') == 'SYP')? "selected":""}}>SYP</option>
                    </select>
                    <input type="text" id="total_price_after_discount" name="total_price_after_discount" placeholder="Total Price After Discount" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-actions form-group" id="add_product_submit_button"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                </form>
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
                        <td>{{$products->sale_price}}</td>
                        <td>{{$products->size}}</td>
                        <td>{{$products->color}}</td>
                        <td>{{$products->quantity}}</td>
                        <td>{{$products->discount}}</td>
                        <td>{{$products->price_after_discount}}</td>
                        <td class="d-flex justify-content-center">
                            <a href="javascript:;" style="font-size:30px;color:green" class="add_row" data-product_id="{{$products->product_id}}" data-name="{{$products->name}}" data-code="{{$products->code}}" data-size="{{$products->size}}" data-sale_price="{{$products->sale_price}}" data-color="{{$products->color}}" data-price_after_discount="{{$products->price_after_discount}}" data-discount="{{$products->discount}}" data-id={{$products->id}}><i class="fa fa-plus-square"></i></a>
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

@section('script')
<script>
    $('.add_row').on('click',function(){
        var name = $(this).data('name');
        var code = $(this).data('code');
        var sale_price = $(this).data('sale_price');
        var size = $(this).data('size');
        var color = $(this).data('color');
        var id = $(this).data('id');
        var product_id = $(this).data('product_id');
        var discount = $(this).data('discount');
        var price_after_discount = $(this).data('price_after_discount');
        var index = parseInt($("#details_index_value").val()) + 1;
        var row = `<div class="form-group">
                        <div class="input-group">
                        <input type="text" name="details[`+index+`]['name']" placeholder="Name" class="form-control" value="`+name+`" disabled>
                        <input type="text" name="details[`+index+`]['code']" placeholder="Code" class="form-control" value="`+code+`" readonly="readonly">
                        <input type="text" name="details[`+index+`]['size']" placeholder="Size" class="form-control" value="`+size+`" disabled>
                        <input type="text" name="details[`+index+`]['color']" placeholder="Color" class="form-control" value="`+color+`" disabled>
                        <input type="text" name="details[`+index+`]['sale_price']" placeholder="Sale Price" class="form-control" value="`+sale_price+`" disabled>
                        <input type="text" name="details[`+index+`]['discount']" placeholder="Discount" class="form-control" value="`+discount+`" disabled>
                        <input type="text" name="details[`+index+`]['price_after_discount']" placeholder="Price After Discount" class="form-control" value="`+price_after_discount+`" disabled>
                        <input type="hidden" name="details[`+index+`]['id']" value="`+id+`">
                        <input type="hidden" name="details[`+index+`]['product_id']" value="`+product_id+`">
                        <input type="text" data-val="1" data-price="`+sale_price+`" data-discount="`+price_after_discount+`" name="details[`+index+`]['quantity']" value="1" class="form-control quantity" placeholder="Quantity">
                        <a href="javascript:;" data-quantity="1" data-price="`+sale_price+`" data-price-discount="`+price_after_discount+`" style="font-size:20px;color:red;margin:10px" class="delete_row"><i class="fa fa-minus-square"></i></a>
                        </div>
                        
                    </div>`;
        
        $("#details_index_value").val(index);
        $("#add_product_submit_button").before(row);

        var total_price = parseFloat($("#total_price").val());
        if(!total_price){
            total_price = 0;
        }
        if(price_after_discount){
            sale_price = price_after_discount;
        }
        $("#total_price").val(total_price + sale_price);
        makeDiscount();
    })

    $(document).on('click', '.delete_row', function(){
        var sale_price = parseFloat($(this).data('price'));
        var quantity = parseInt($(this).data('quantity'));
        var discount_price = parseFloat($(this).data('price-discount'));
        $(this).closest('.form-group').remove();
        var total_price = parseFloat($("#total_price").val());

        if(discount_price){
            sale_price = discount_price;
        }
        $("#total_price").val(total_price - (sale_price * quantity));
        makeDiscount();
    })

    $("#select").change(function(){
        makeDiscount();
    })

    $("#discount").keyup(function(){
        makeDiscount();
    })

    $(document).on('keyup','.quantity', function(){
        var quantity = $(this).val();
        var price = parseFloat($(this).data('price'));
        var old_quantity = parseInt($(this).data('val'));
        var discount = parseFloat($(this).data('discount'));
        var total_price = parseFloat($("#total_price").val());
        
        quantity = (!quantity)? 0:quantity;
        $(this).data('val',quantity);

        if(discount){
            price = discount;
        }

        total_price -= (price * old_quantity);

        $("#total_price").val(total_price + (price * quantity));
        $(this).next('.delete_row').data('quantity',quantity);
        makeDiscount();
    })

    function makeDiscount(){
        var total_price = parseFloat($("#total_price").val());
        var selected = $("#select").val();
        var discount = $("#discount").val();

        if(selected == '%'){
            $("#total_price_after_discount").val(total_price - (total_price * (discount / 100)));
        }else if(selected == 'SYP'){
            $("#total_price_after_discount").val(total_price - discount);
        }else if(selected == 0){
            $("#total_price_after_discount").val('');
        }
    }
</script>
@endsection