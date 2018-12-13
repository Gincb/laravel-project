@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Projects List
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('project.create') }}">{{ __('New') }}</a>
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
                            <th>Cover</th>
                            <th>Description</th>
                            <th></th>
                        </tr>

                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->title }}</td>
                                <td>
                                    @if ($project->cover)
                                        <img width="100" src="{{ Storage::url($project->cover) }}">
                                    @endif
                                </td>
                                <td>{{ $project->description }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-dark btn-block" href="{{ route('project.show', [$project->id]) }}">{{ __('View') }}</a>
                                    <form action="{{ route('project.destroy', [$project->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <input class="btn btn-sm btn-outline-dark btn-block " type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                        {{ $projects->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
