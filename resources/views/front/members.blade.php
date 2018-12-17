@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{ __('Our Members') }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex flex-wrap">
                                @foreach($members as $item)
                                    <div class="m-3" style="width: 400px;">
                                        @if($item->photo)
                                            <img class="img-thumbnail" src="{{ Storage::url($item->photo) }}" alt="Card image cap" width="200">
                                        @endif
                                        <h5 class="card-title">{{ $item->first_name }} {{ $item->last_name }}</h5>
                                        <p class="card-text">{{ str_limit($item->position, 150) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">{{ $members->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
