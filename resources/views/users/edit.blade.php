@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit user #{{ $user->id }}</div>

                <div class="card-body">

					<users-modify :user="{{ $user->toJson() }}">Edit:</users-modify>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <a href="{{ url('/users') }}" class="btn btn-secondary">
                        <i class="fa fa-chevron-left"></i>
                        Return to users list
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection