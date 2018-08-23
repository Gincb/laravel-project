@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Member list for team {{ $team->title }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>Member</th>
                            <th>Position</th>
                        </tr>
                        @foreach($team->members as $member)
                        <tr>
                            <td>
                                <div class="form_group">
                                        <label for="member_{{ $member->id }}">
                                             {{ $member->first_name }} {{ $member->last_name }}
                                        </label>
                                </div>
                            </td>
                            <td>
                                <label for="member_{{ $member->id }}">
                                    <p><em>{{ $member->position }}</em></p>
                                </label>
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
                    <a class="btn btn-block btn-outline-dark" href="{{ route('team.edit', [$team->id]) }}">{{ __('Edit team') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
