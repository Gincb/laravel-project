@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    New Project
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}:</label>
                            <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}">
                            @if($errors->has('title'))
                                <div class="alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cover">{{ __('Cover') }}</label>
                            <input id="cover" class="form-control" type="file" name="cover" accept=".jpg, .jpeg, .png">
                            @if($errors->has('cover'))
                                <div class="alert-danger">{{ $errors->first('cover') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}:</label>
                            <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="alert-danger">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="team_id">{{ __('Teams') }}:</label>
                            <select id="team_id" class="form-control" name="team_id">
                                <option value=""> ---</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ ($team->id == old('team_id') ? 'selected' : '') }}>{{ $team->title }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('team_id'))
                                <div class="alert-danger">{{ $errors->first('team_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="objective_id">{{ __('Objective') }}:</label>
                            <select id="objective_id" class="form-control" name="objective_id">
                                <option value=""> ---</option>
                                @foreach($objectives as $objective)
                                    <option value="{{ $objective->id }}" {{ ($objective->id == old('objective_id') ? 'selected' : '') }}>{{ $objective->title }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('objective_id'))
                                <div class="alert-danger">{{ $errors->first('objective_id') }}</div>
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
