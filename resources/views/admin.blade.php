@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <h5 style="text-align: center; padding: 15px;">Welcome {{ Auth::user()->name }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection
