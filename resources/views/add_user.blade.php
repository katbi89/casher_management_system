@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header">Add User</div>
            <div class="card-body card-block">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                </div>
                @endif
                <form action="{{url('/add-user')}}" method="post">
                    @csrf
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{old('name')}}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                    <input type="email" name="email" placeholder="Email" class="form-control" value="{{old('email')}}">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                    </div>
                    @error('confirm_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <div class="col col-md-9">
                        <div class="form-check">
                          <div class="radio">
                            <label for="radio1" class="form-check-label ">
                              <input type="radio" id="radio1" name="role" value="admin" class="form-check-input" {{(old('role') == 'admin')? "checked":''}}>Admin
                            </label>
                          </div>
                          <div class="radio">
                            <label for="radio2" class="form-check-label ">
                              <input type="radio" id="radio2" name="role" value="casher" class="form-check-input" {{(old('role') == 'casher')? "checked":''}}>Casher
                            </label>
                          </div>
                            @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection