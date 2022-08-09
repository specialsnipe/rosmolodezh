@extends('layouts.main')

@section('content')
<div class="container main-container post-show-container">
    <div class="flex-container post-show">

    @if($post->images->count() > 1)
    <div class="images-header slider">
        <div class="slider__wrapper">
            <div class="slider__items">
                @foreach ($post->images as $image)
                    <div class="slider__item">
                        <img src="{{ asset($image->original_image) }}" alt="">
                    </div>
                @endforeach
            </div>
       </div>
       <a class="slider__control slider__control_prev" href="#" role="button" data-slide="prev"></a>
       <a class="slider__control slider__control_next" href="#" role="button" data-slide="next"></a>

        <a href="{{ url()->previous() }}" class="btn-back">Назад</a>
    </div>
    @else
    <div class="images-header">
        <img src="{{ asset($post->images[0]->original_image) }}" alt="">
        <a href="{{ url()->previous() }}" class="btn-back">Назад</a>
    </div>
    @endif
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
@endsection
@push('script')
    <script defer>
        const sldier = new SimpleAdaptiveSlider('.slider', {
            loop: true,
            autoplay: false,
            interval: 5000,
            swipe: true,
        });
    </script>
@endpush
