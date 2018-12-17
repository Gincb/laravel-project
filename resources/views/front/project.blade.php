@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header h4">{{ $project->title }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if($project->cover)
                                    <img class="card-img" src="{{ Storage::url($project->cover) }}" alt="Card image cap">
                                @endif
                            </div>

                            {{--<div class="col-md-8">--}}
                                {{--<p class="card-text">{{ __('Created by:') }} {{ $article->authors->first_name }} {{ $article->authors->last_name }}</p>--}}
                                {{--<ul class="list-group list-group-flush">--}}
                                    {{--<p>{{ __('Categories:') }}</p>--}}
                                    {{--@foreach($article->categories as $category)--}}
                                        {{--<li class="list-group-item"><em><a href="{{ route('front.category.articles', $category->slug) }}">{{ $category->title }}</a></em></li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                                {{--<p class="card-text text-right"><small class="text-muted">{{ __('Posted at:') }} {{ $article->created_at }}</small></p>--}}
                            {{--</div>--}}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <p class="card-text">{{ $project->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
