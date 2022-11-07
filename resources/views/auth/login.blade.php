@extends('layout')
@section('title', 'Login Page')

@section('content')


<div style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if (session('status'))
                <div class="" style="padding-top: 20px;">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <div class="text-center text-success">{{ session('status') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <h3 class="text-center" style="padding-bottom: 20px;">User Management & Payment Method</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
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
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" value="{{ old('remember') ? 'checked': '' }}">
                        <label for="remember" class="form-check-label">Remember Me</label>
                    </div>
                </div>
    
                <div class="form-group">
                    <input type="submit" value="Login" class="btn btn-primary btn-block">
                </div>
            </form>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('register') }}">New user? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection