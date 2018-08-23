@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Teams List
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('team.create') }}">{{ __('New') }}</a>
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

                        @foreach($teams as $team)
                            <tr>
                                <td>{{ $team->id }}</td>
                                <td>{{ $team->title }}</td>
                                <td>{{ $team->slug }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-dark btn-block" href="{{ route('team.show', [$team->id]) }}">{{ __('View') }}</a>
                                    <form action="{{ route('team.destroy', [$team->id]) }}" method="post">
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <a class="btn btn-block btn-outline-dark" href="{{ route('member.index') }}">{{ __('Member list') }}</a>
                    <a class="btn btn-block btn-outline-dark" href="{{ route('member.create') }}">{{ __('Add a new member') }}</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
