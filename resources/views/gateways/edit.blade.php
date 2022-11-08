@extends('layout')
@section('title', 'Edit Payment Gateway')

@section('content')


<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">Edit Payment Gateway</h3>
        <form action="{{ route('get.payment.gateway', [$gateway->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $gateway->name }}" class="form-control">
            </div>

            <div class="form-group">
                @php
                    $val = '';
                    $status = '';
                @endphp
                @if ($gateway->status === 'Active')
                    @php
                        $status = 'Active';
                        $val = 'No';
                    @endphp
                @else
                    @php
                        $status = 'No';
                        $val = 'Active';
                    @endphp
                @endif
                <label for="">Status</label>
                <select name="status" class="form-control">
                    <option value="{{ $status }}" selected>{{ $status }}</option>
                    <option value="{{ $val }}">{{ $val }}</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>
</div>

@endsection