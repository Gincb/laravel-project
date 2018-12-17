@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Members List
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('member.create') }}">{{ __('New') }}</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Position</th>
                            <th></th>
                        </tr>

                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>
                                    @if ($member->photo)
                                        <img width="100" src="{{ Storage::url($member->photo) }}">
                                    @endif
                                </td>
                                <td>{{ $member->first_name }}</td>
                                <td>{{ $member->last_name }}</td>
                                <td>{{ $member->position }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-dark btn-block" href="{{ route('member.edit', [$member->id]) }}">{{ __('Edit') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <a class="btn btn-outline-dark" href="javascript:history.back();">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
