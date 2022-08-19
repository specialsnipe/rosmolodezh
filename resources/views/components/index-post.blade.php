@php
use App\Models\Post;
$posts = Post::latest()->limit(4)->get();

@endphp

<div class="row mb-3 justify-content-between">
    @forelse ($posts as $post)
    <div class="col-md-3 col-sm-12">
        <div class="card post_card">
            <img src="{{ asset($post->images['0']->thumbnail_image) }}" class="rounded img-fluid"
                style="min-height: 200px; max-height:200px"
                alt="Изображение поста '{{ $post->title }}'" height="100">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text post__card-text">{{ $post->excerpt }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn">Подробнее</a>
            </div>
        </div>
    </div>

    @empty
    Новостей пока что нет
    @endforelse
</div>
