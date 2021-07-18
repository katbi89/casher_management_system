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
                    <strong class="card-title">Data table</strong>
                </div>
                <div class="card-body">
                    Filter Total Cost<input id="cost-filter" type="text" class="form-control col-2 mb-3" value="2500">
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
        function getCustomers(cost)
        {
            $.ajax({
                url: '/special-customers/'+cost,
                method: 'GET',
                success: function(response) {
                    if(response){
                        var body = '';
                        for(let i = 0; i < response.length; i++){

                            body += `<tr>
                                            <td>`+response[i].name+`</td>
                                            <td>`+response[i].phone+`</td>
                                            <td>`+response[i].evaluation+`</td>
                                            <td>`+response[i].cost+`</td>
                                            <td>`+response[i].cost_after_discount+`</td>
                                            <td class="d-flex">
                                                <a href="https://wa.me/+2`+response[i].phone+`" style="color:green;font-weight:bold;text-align:center">Send Whatsapp Message</a>
                                            </td>
                                        </tr>`;
                        }

                        $("#table-body").html(body);
                    }
                }
            })
        }

        getCustomers(2500);

        $("#cost-filter").keyup(function(){
            var cost = $(this).val();
            if(cost){
                getCustomers(cost);
            }
        })
    </script>
@endsection