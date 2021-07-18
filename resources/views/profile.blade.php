@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header">Update Your Information</div>
            <div class="card-body card-block">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                </div>
                @endif
                <form action="{{url('/update-user')}}" method="post">
                    @csrf
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{(old('name'))?? $user->name}}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                    <input type="email" name="email" placeholder="Email" class="form-control" value="{{(old('email'))?? $user->email}}">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                    <input type="password" name="password" placeholder="New Password" class="form-control">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                    <input type="password" name="confirm_password" placeholder="Confirm New Password" class="form-control">
                    </div>
                    @error('confirm_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection