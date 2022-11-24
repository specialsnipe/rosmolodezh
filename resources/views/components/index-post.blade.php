@props(['posts'])

@php
use App\Models\Post;
if (!isset($posts)) {
    $posts = Post::latest()->limit(4)->get();
}

@endphp

<div class="row">
    @forelse ($posts as $post)
    <div class="col-sm-12 col-md-6 col-lg-3 h-100">
        <a class="text-decoration-none" style="color: #000;" target="_blank" href="{{ route('posts.show', $post->slug) }}">
            <div class="card post_card mb-4">
                <img src="{{ $post->images[0]->imageNormal }}" class="rounded img-fluid"
                    style="min-height: 200px; max-height:200px"
                    alt="Изображение поста '{{ $post->title }}'" height="100">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text post__card-text">{{ $post->excerpt }}</p>
                </div>
            </div>
        </a>
    </div>

    @empty
    Новостей пока что нет
    @endforelse
</div>
