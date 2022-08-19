@extends('layouts.main')

@section('content')
<div class="screen screen-directions">
    <div class="main-container-directions">
        <div class="container m-0 p-0">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    @if($post->images->count() > 1)
                    <div class="slider w-100">
                        <div class="slider__wrapper">
                            <div class="slider__items">
                                @foreach ($post->images as $image)
                                    <div class="slider__item">
                                        <img src="{{ asset($image->original_image) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <a class="slider__control slider__control_prev" href="#" role="button" data-slide="prev"></a>
                    <a class="slider__control slider__control_next" href="#" role="button" data-slide="next"></a>

                    </div>
                    @else
                    <img src="{{ asset($post->images[0]->original_image) }}" class="img-fluid rounded" alt="">
                    @endif
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="">
                        <div class="h2">Другие интересные статьи</div>
                        <div class="line mt-3 mb-3"></div>
                        <div class="link-content">
                            @foreach ($posts as $post)

                            <a href="{{ route('posts.show', $post->id) }}" class="">
                                <p class="h5">{{ $post->title }}</p>
                                <p class="text-truncate">{{ $post->excerpt }}</p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <span class="h2">{{ $post->title }}</span>
                    <p class="mt-3">{!! $post->body !!}</p>
                    <div class="line mt-2 mb-2"></div>

                    <p class="h2">Полезные ссылки:</p>
                    <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
                    <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
                    <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
                    <a href="" class="link-text">https://habr.com/ru/post/675130/</a>
                </div>
            </div>
        </div>

        @guest
        <div class="screen register-screen">
            <x-registration-form></x-registration-form>
        </div>
        @endguest
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
