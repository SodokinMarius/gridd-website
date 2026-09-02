@props(['project'])

<a href="{{ route('projects.show', $project) }}" class="project-card block group">
    <div class="project-media">
        @if ($project->coverImage)
            <img src="{{ \App\Support\Media::url($project->coverImage->path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        @else
            <div class="img-placeholder w-full h-full"></div>
        @endif
    </div>
    <div class="project-overlay">
        <div class="text-paper">
            <p class="text-xs text-primary-300 mb-1">{{ $project->country }}</p>
            <p class="font-display font-medium">{{ $project->title }}</p>
        </div>
    </div>
</a>
