@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    New objective
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('objective.store') }}" method="post">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}:</label>
                            <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}">
                            @if($errors->has('title'))
                                <div class="alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form_group">
                            <label>{{ __('Tasks') }}</label>
                            <br>
                            @foreach($plans as $plan)
                                <label for="plan_{{ $plan->id }}">
                                    <input id="plan_{{ $plan->id }}" type="checkbox" name="plan[]"
                                           value="{{ $plan->id }}"
                                            {{ (in_array($plan->id, old('plan', $plan->pluck('id')->toArray())) ? 'checked' : '') }}
                                    > {{ $plan->task }}
                                </label>
                                <br>
                            @endforeach
                            @if($errors->has('plan'))
                                <div class="alert-danger">{{ $errors->first('plan') }}</div>
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
