@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                
                <div class="card-body">
                    <p>This feature was disabled</p>
                    <a href="{{ url('login') }}" class="btn btn-primary">Return to login page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
