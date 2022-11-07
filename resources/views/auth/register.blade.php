@extends('layout')
@section('title', 'Register User')

@section('content')


<div class="" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Register</h3>
            @if (session('message'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div class="text-center">{{ message }}</div>
                </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : ''  }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" required 
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : ''  }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            
                <div class="form-group">
                    <label for="email">Password</label>
                    <input type="password" name="password" required 
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : ''  }}">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="form-control">
                </div>
    
                <div class="form-group">
                    <input type="submit" value="Register" class="btn btn-primary btn-block">
                </div>
            </form>
            <p>
                <a href="{{ route('index') }}">Login</a>
            </p>
        </div>
    </div>
</div>

@endsection