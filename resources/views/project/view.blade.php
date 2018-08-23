@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    View Project: {{ $project->title }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <td>{{ __('Title') }}:</td>
                            <td>{{ $project->title }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Description') }}:</td>
                            <td>{{ $project->description }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Categories') }}:</td>
                            <td>
                                <div class="form_group">
                                    @foreach($project->categories as $category)
                                        <label for="category_{{ $category->id }}">
                                             {{ $category->title }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('Team') }}:</td>
                            <td>{{ $project->teams->title }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Slug') }}:</td>
                            <td>{{ $project->slug }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Created at') }}:</td>
                            <td>{{ $project->created_at }}</td>
                        </tr>
                    </table>

                    <a class="btn btn-outline-dark" href="javascript:history.back();">Back</a>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <a class="btn btn-block btn-outline-dark" href="{{ route('project.edit', [$project->id]) }}">{{ __('Edit project') }}</a>
                    <a class="btn btn-block btn-outline-dark" href="{{ route('team.show', [$project->id]) }}">{{ __('Team members') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
