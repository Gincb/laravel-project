@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{ __('All Projects') }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex flex-wrap">
                                @foreach($projects as $item)
                                    <div class="m-3" style="width: 400px;">
                                        @include('front.partials._project', ['project' => $item])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">{{ $projects->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
