@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Objectives List
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('objective.create') }}">{{ __('New') }}</a>
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

                        @foreach($objectives as $objective)
                            <tr>
                                <td>{{ $objective->id }}</td>
                                <td>{{ $objective->title }}</td>
                                <td>{{ $objective->slug }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-dark btn-block" href="{{ route('objective.show', [$objective->id]) }}">{{ __('View') }}</a>
                                    <form action="{{ route('objective.destroy', [$objective->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <input class="btn btn-sm btn-outline-dark btn-block " type="submit" value="Delete">
                                    </form>
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
