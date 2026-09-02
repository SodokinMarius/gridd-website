@props(['testimonial'])

<article class="testimonial-card">
    <div class="testimonial-card-header">
        <div class="testimonial-card-photo">
            <x-responsive-image :src="$testimonial->photo" :alt="$testimonial->full_name" class="w-full h-full object-cover" />
        </div>
        <div>
            <p class="font-display font-semibold">{{ $testimonial->full_name }}</p>
            <p class="text-sm text-primary-600 mt-0.5">{{ $testimonial->position }}</p>
        </div>
    </div>
    <blockquote class="testimonial-card-content">
        « {{ $testimonial->content }} »
    </blockquote>
</article>
