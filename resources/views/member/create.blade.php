@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    New Member
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('member.store') }}" method="post" enctype="multipart/form-data">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="photo">{{ __('Photo') }}</label>
                            <input id="photo" class="form-control" type="file" name="photo" accept=".jpg, .jpeg, .png">
                            @if($errors->has('photo'))
                                <div class="alert-danger">{{ $errors->first('photo') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="first_name">{{ __('First name') }}:</label>
                            <input id="first_name" class="form-control" type="text" name="first_name" value="">

                            @if($errors->has('first_name'))
                                <div class="alert-danger">{{$errors->first('first_name')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last name') }}:</label>
                            <input id="last_name" class="form-control" type="text" name="last_name" value="">

                            @if($errors->has('last_name'))
                                <div class="alert-danger">{{$errors->first('last_name')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="position">{{ __('Position') }}:</label>
                            <input id="position" class="form-control" type="text" name="position" value="">

                            @if($errors->has('position'))
                                <div class="alert-danger">{{$errors->first('position')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input class="btn btn-dark-outline" type="submit" value="{{ __('Save') }}">
                        </div>

                    </form>
                    <a class="btn btn-outline-dark" href="javascript:history.back();">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
