@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header">Make Discount</div>
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
                <form action="{{url('/make-discount')}}" method="post">
                    @csrf
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" name="code" placeholder="Product Code" class="form-control" value="{{old('code')}}">
                    </div>
                    @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row form-group">
                    <div class="col col-md-8">
                        <input type="text" placeholder="Discount" class="form-control" name="discount" value="{{old('discount')}}">
                        @error('discount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col col-md-4">
                        <select name="type" id="select" class="form-control">
                            <option value="%" {{(old('type') == '%')? "selected":""}}>%</option>
                            <option value="SYP" {{(old('type') == 'SYP')? "selected":""}}>SYP</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection