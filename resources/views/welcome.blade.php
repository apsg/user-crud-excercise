@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">What would you like to do?</div>

                <div class="card-body">
                    
                    @guest
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <a href="{{ url('/register') }}" class="btn btn-secondary">Create new admin account</a>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <a href="{{ url('users') }}" class="btn btn-success">
                                Start managing users
                            </a>
                        </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</div>
@endsection