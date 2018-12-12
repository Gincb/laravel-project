@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Categories List
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('plan.create') }}">{{ __('New') }}</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th></th>
                        </tr>

                        @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->id }}</td>
                                <td>{{ $plan->title }}</td>
                                <td>{{ $plan->slug }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-dark btn-block" href="{{ route('plan.edit', [$plan->id]) }}">{{ __('Edit') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
