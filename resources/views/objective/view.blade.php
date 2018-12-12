@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tasks for objective: {{ $objective->title }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table">
                            <th>{{ __('Task') }}</th>
                            <th>{{ __('Action') }}</th>
                            @foreach($objective->plans as $plan)
                                <tr>
                                    <td>
                                        <div class="form_group">
                                            <label for="plan_{{ $plan->id }}">
                                                {{ $plan->task}}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-dark" href="{{ route('plan.edit', [$plan->id]) }}">{{ __('Edit task') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>



                    <a class="btn btn-outline-dark" href="javascript:history.back();">Back</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Actions</div>
                <div class="card-body">
                        <a class="btn btn-block btn-outline-dark" href="{{ route('objective.edit', [$objective->id]) }}">{{ __('Edit objective and add new tasks') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection