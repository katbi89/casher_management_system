@extends('layouts.login')

@section('content')
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h1 class="text-center fs-1">CASHER MANAGEMENT SYSTEM</h1>
                </div>
                <div class="login-form">
                    @if(isset($error))
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endif
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                    </div>
                    @endif
                    <form action="{{url('/login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }} {{(isset($oldEmail)) ? $oldEmail:''}}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endSection