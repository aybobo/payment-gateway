@extends('layout')
@section('title', 'Dashboard')

@section('content')

@if (session('message'))
    <div class="" style="padding-top: 20px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div class="text-center text-success">{{ session('message') }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="" style="margin-bottom: 30px;">
            <div class="row">
                <div class="col-md-8">
                    <h3>Payment Methods</h3>
                </div>
                <div class="col-md-4">
                    <a href="#addPaymentMethod" data-toggle="modal" class="btn btn-primary">Add Payment Method</a>
                </div>
            </div>
        </div>
        @if (count($all_methods) > 0)
            
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($all_methods as $all_method)
                    <tr>
                        <td>{{ $all_method->name }}</td>
                        <td><a href="{{ route('get.payment.method', [$all_method->id]) }}" class="btn btn-default btn-sm border border-dark rounded">Edit</a></td>
                        <td>
                            <form action="{{ route('delete.payment.method', [$all_method->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm border border-dark rounded">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>No Payment Method</h3>
        @endif
    </div>
</div>

<!-- start modal -->
<div class="modal fade" id="addPaymentMethod" tabindex="-1" role="dialog" aria-labelledby="addPaymentMethod" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Payment Method</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <form action="{{ route('post.payment.method') }}" method="post">
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
                <button type="submit" class="btn btn-primary m-b-20">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
<!-- end modal -->

@endsection