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

                    <form action="{{ route('project.store') }}" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}:</label>
                            <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}">
                            @if($errors->has('title'))
                                <div class="alert-danger">{{ $errors->first('title') }}</div>
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
                            <label>{{ __('Categories') }}</label>
                            <br>
                            @foreach($categories as $category)
                                <label for="category_{{ $category->id }}">
                                    <input id="category_{{ $category->id }}" type="checkbox" name="category[]" value="{{ $category->id }}" {{(in_array($category->id, old('category', [])) ? 'checked' : '')}}> {{ $category->title }}
                                </label>
                                <br>
                                @endforeach
                            @if($errors->has('category'))
                                <div class="alert-danger">{{ $errors->first('category') }}</div>
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
