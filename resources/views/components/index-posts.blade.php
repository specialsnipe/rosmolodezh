@php
use App\Models\Post;
use Carbon\Carbon;
$posts = Post::latest()->limit(12)->get();

@endphp

<div class="row mb-3 justify-content-between">
    @forelse ($posts as $post)
    <div class="card col-md-3 col-sm-12 ">
        <img src="{{ asset($post->images['0']->thumbnail_image) }}" class="rounded img-fluid"
            alt="Изображение поста '{{ $post->title }}'" height="100">
        <div class="card-body">
            <span class="card-text post__card-text" style="font-size: 13px; color: #ababab">дата: {{ Carbon::parse($post->created_at)->format("Y/m/d") }}</span>
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->excerpt }}</p>
            <a target="_blank" href="{{ route('posts.show', $post->id) }}" class="btn">Подробнее</a>
        </div>
    </div>

    @empty
    Новостей пока что нет
    @endforelse
</div>
