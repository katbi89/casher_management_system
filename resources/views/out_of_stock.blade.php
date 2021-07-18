@extends('layouts.main')

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Table</strong>
                </div>
                <div class="card-body">
                    Filter Quantity<input id="quantity-filter" type="text" class="form-control col-2 mb-3" value="5">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody id="table-body">
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
        function getProducts(quantity)
        {
            $.ajax({
                url: '/out-of-stock/'+quantity,
                method: 'GET',
                success: function(response) {
                    if(response){
                        var body = '';
                        for(let i = 0; i < response.length; i++){

                            body += `<tr>
                                            <td>`+response[i].name+`</td>
                                            <td>`+response[i].code+`</td>
                                            <td>`+response[i].size+`</td>
                                            <td>`+response[i].color+`</td>
                                            <td>`+response[i].quantity+`</td>
                                        </tr>`;
                        }

                        $("#table-body").html(body);
                    }
                }
            })
        }

        getProducts(5);

        $("#quantity-filter").keyup(function(){
            var quantity = $(this).val();
            if(quantity){
                getProducts(quantity);
            }
        })
    </script>
@endsection