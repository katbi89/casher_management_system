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
                <th>Email</th>
                <th>Role</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
                @if ($users)
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <form action="{{url('/delete-user')}}" method="post">
                                @csrf
                                    <input type="hidden" value="{{$user->id}}" name="id"/>
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