@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Member
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('member.update', [$member->id]) }}" method="post" enctype="multipart/form-data">

                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="photo">{{ __('Photo') }}</label>
                            @if ($member->photo)
                                <br>
                                <img width="200" src="{{ Storage::url($member->photo) }}">
                            @endif
                            <input id="photo" class="form-control" type="file" name="photo" accept=".jpg, .jpeg, .png">
                            @if($errors->has('photo'))
                                <div class="alert-danger">{{ $errors->first('photo') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="first_name">{{ __('First name') }}:</label>
                            <input id="first_name" class="form-control" type="text" name="first_name"
                                   value="{{ old('first_name', $member->first_name) }}">
                            @if($errors->has('first_name'))
                                <div class="alert-danger">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last name') }}:</label>
                            <input id="last_name" class="form-control" type="text" name="last_name"
                                   value="{{ old('last_name', $member->last_name) }}">
                            @if($errors->has('last_name'))
                                <div class="alert-danger">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="position">{{ __('Position') }}:</label>
                            <input id="position" class="form-control" type="text" name="position"
                                   value="{{old('position', $member->position)}}">

                            @if($errors->has('position'))
                                <div class="alert-danger">{{$errors->first('position')}}</div>
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
