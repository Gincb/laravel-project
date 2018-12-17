@if($project->cover)
    <img class="img-thumbnail" src="{{ Storage::url($project->cover) }}" alt="Card image cap" width="200">
@endif
    <h5 class="card-title"><a href="{{ route('front.project.slug', $project->slug) }}">{{ $project->title }}</a></h5>
    <p class="card-text">{{ str_limit($project->description, 150) }}</p>