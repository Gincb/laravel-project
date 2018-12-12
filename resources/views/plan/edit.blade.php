@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit plan
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('plan.update', [$plan->id]) }}" method="post">

                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="task">{{ __('task') }}:</label>
                            <input id="task" class="form-control" type="text" name="task" value="{{ old('task', $plan->task) }}">
                            @if($errors->has('task'))
                                <div class="alert-danger">{{ $errors->first('task') }}</div>
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
