@extends('layout')
@section('title', 'PaymentGateways')

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
                    <h3>Payment Gateways</h3>
                </div>
                <div class="col-md-4">
                    <a href="#addPaymentGateway" data-toggle="modal" class="btn btn-primary">Add Payment Gateway</a>
                </div>
            </div>
        </div>
        @if (count($gateways) > 0)
            
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($gateways as $gateway)
                    <tr>
                        <td>{{ $gateway->name }}</td>
                        <td>{{ $gateway->status }}</td>
                        <td><a href="{{ route('get.payment.gateway', [$gateway->id]) }}" class="btn btn-default btn-sm border border-dark rounded">Edit</a></td>
                        <td>
                            <form action="{{ route('delete.payment.gateway', [$gateway->id]) }}" method="post">
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
            <h3>No Payment Gateway</h3>
        @endif
        <div class="" style="margin-top: 20px;">
            <a href="{{ route('index.payment.methods') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>

<!-- start modal -->
<div class="modal fade" id="addPaymentGateway" tabindex="-1" role="dialog" aria-labelledby="addPaymentGateway" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Payment Gateway</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <form action="{{ route('post.payment.gateway') }}" method="post">
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