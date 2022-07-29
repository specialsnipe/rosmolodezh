@extends('layouts.main')

@section('content')
<div class="container main-container">
    <div class="images-header">
        <img src="" alt="">
        <a href="{{ url()->previous() }}" class="btn-back">Назад</a>
    </div>
    <div class="flex-container">
        <div class="text-container">
            <p class="text-h1">{{ $post->title }}</p>
            <div class="line"></div>
            <p class="text-p">{!! $post->body !!}</p>

            <p class="text-h1">Полезные ссылки:</p>
            <div class="line"></div>
            <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
            <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
            <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
            <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
        </div>

        <div class="right-block-info">
            <div class="text-h1">Другие интересные статьи</div>
            <div class="line"></div>
            <div class="link-content">
                @foreach ($posts as $post)

                <a href="{{ route('posts.show', $post->id) }}">
                    <p class="text-h1">{{ $post->title }}</p>
                    <p class="text-truncate">{{ $post->excerpt }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
