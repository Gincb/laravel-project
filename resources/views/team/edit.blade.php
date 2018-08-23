@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Category
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('team.update', [$team->id]) }}" method="post">

                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}:</label>
                            <input id="title" class="form-control" type="text" name="title" value="{{ $team->title }}">
                            @if($errors->has('title'))
                                <div class="alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form_group">
                            <label>{{ __('Members') }}</label>
                            <br>
                            @foreach($members as $member)
                                <label for="member_{{ $member->id }}">
                                    <input id="member_{{ $member->id }}" type="checkbox" name="member[]"
                                           value="{{ $member->id }}"
                                            {{ (in_array($member->id, old('member', $team->members->pluck('id')->toArray())) ? 'checked' : '') }}
                                    > {{ $member->first_name }} {{ $member->last_name }}
                                </label>
                                <br>
                            @endforeach
                            @if($errors->has('member'))
                                <div class="alert-danger">{{ $errors->first('member') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="slug">{{ __('Slug') }}:</label>
                            <input id="slug" class="form-control" type="text" name="slug" value="{{ $team->slug}}">
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
