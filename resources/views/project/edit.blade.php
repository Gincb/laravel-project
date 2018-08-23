@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Project
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('project.update', [$project->id]) }}" method="post">

                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}:</label>
                            <input id="title" class="form-control" type="text" name="title" value="{{ $project->title }}">
                            @if($errors->has('title'))
                                <div class="alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}:</label>
                            <textarea id="description" class="form-control" name="description">{{ $project->description }}</textarea>
                            @if($errors->has('description'))
                                <div class="alert-danger">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                        <div class="form_group">
                            <label>{{ __('Categories') }}</label>
                            <br>
                            @foreach($categories as $category)
                                <label for="category_{{ $category->id }}">
                                    <input id="category_{{ $category->id }}" type="checkbox" name="category[]"
                                           value="{{ $category->id }}"
                                            {{ (in_array($category->id, old('category', $project->categories->pluck('id')->toArray())) ? 'checked' : '') }}
                                    > {{ $category->title }}
                                </label>
                                <br>
                            @endforeach
                            @if($errors->has('category'))
                                <div class="alert-danger">{{ $errors->first('category') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="team_id">{{ __('Teams') }}:</label>
                            <select id="team_id" class="form-control" name="team_id">
                                <option value=""> ---</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ ($team->id == old('team_id', $project->team_id) ? 'selected' : '') }}>{{ $team->title }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('team_id'))
                                <div class="alert-danger">{{ $errors->first('team_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="slug">{{ __('Slug') }}:</label>
                            <input id="slug" class="form-control" type="text" name="slug" value="{{ $project->slug }}">
                            @if($errors->has('slug'))
                                <div class="alert-danger">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input class="btn btn-dark-outline" type="submit" value="{{ __('Save') }}">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
