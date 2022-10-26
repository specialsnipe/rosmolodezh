@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@push('seo')
<meta name='keywords' content='{{ $post->keywords ?? ' Новость' }}'>
{!! seo()->for($post) !!}
@endpush

@section('content')
<div class="screen container">
    <div class="main-container-directions">
        <div class="container m-0 p-0">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    @if($post->images->count() > 1)
                    <div class="slider" style="max-width: 100% !important">
                        <div class="slider__wrapper">
                            <div class="slider__items">
                                @foreach ($post->images as $image)
                                <div class="slider__item" style="max-height: 500px">
                                    <img src="{{ $image->imageMedium }}" class="w-100 rounded" alt="" style="object-fit: contain; max-height: 650px">
                                </div>
                                @endforeach
                            </div>

                            <a class="slider__control slider__control_prev" href="#" role="button"
                                data-slide="prev"></a>
                            <a class="slider__control slider__control_next" href="#" role="button"
                                data-slide="next"></a>
                        </div>
                    </div>


                    @else
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset($post->images[0]->imageMedium) }}" class="rounded single-image" alt="" style="object-fit: contain; max-height: 650px; max-width: 100%">
                    </div>
                    @endif
                </div>
                <div class="col-sm-12 col-md-4  d-lg-block d-md-none d-sm-none">
                    <div class="">
                        <div class="h2">Другие интересные статьи</div>
                        <div class="line mt-3 mb-0"></div>
                        <div class="link-content">
                            @foreach ($posts as $postx)
                            <a href="{{ route('posts.show', $postx->id) }}" class="">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <p class="h5"><i class="fas fa-external-link-alt" style="font-size: 16px;"></i> {{ $postx->title }} </p>
                                        <p class="text-truncat-1 ">{{ $postx->excerpt }} </p>
                                    </div>
                                </div>
                            </a>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <span class="h2">{{ $post->title }}</span>
                <p class="mt-3">{!! $post->body !!}</p>
                {{-- <div class="line mt-2 mb-2"></div> --}}

                {{-- <p class="h2">Полезные ссылки:</p>
                <div class="row">
                    <a href="" class="col-12 link-text">https://habr.com/ru/post/675130/</a>
                    <a href="" class="col-12 link-text">https://habr.com/ru/post/675130/</a>
                    <a href="" class="col-12 link-text">https://habr.com/ru/post/675130/</a>
                    <a href="" class="col-12 link-text">https://habr.com/ru/post/675130/</a>
                </div> --}}

            </div>
            <div class="col-sm-12  d-lg-none d-md-block">
                <div class="">
                    <div class="h2">Другие интересные статьи</div>
                    <div class="line mt-3 mb-0"></div>
                    <div class="link-content">
                        @foreach ($posts as $postx)
                        <a href="{{ route('posts.show', $postx->id) }}" class="">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <p class="h5"><i class="fas fa-external-link-alt" style="font-size: 16px;"></i> {{ $postx->title }} </p>
                                    <p class="text-truncat-1 ">{{ $postx->excerpt }} </p>
                                </div>
                            </div>
                        </a>

                        @endforeach
                    </div>
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
</div>

@endsection
@push('script')
<script defer>
    let sliderBlock = document.querySelector('.slider');
    if (sliderBlock) {
        const slider = new SimpleAdaptiveSlider('.slider', {
            loop: true,
            autoplay: false,
            interval: 5000,
            swipe: true,
        });
    }

    const spans = document.querySelectorAll('span');
    const p = document.querySelectorAll('p');

    spans.forEach(span => {
        span.style.fontFamily = '';
    });

    p.forEach(span => {
        span.style.fontFamily = '';
    });
    const singleImage = document.querySelector('.single-image');
    if (singleImage) {
        const y = singleImage.scrollHeight;
        const x = singleImage.scrollWidth;
        if (y > x) {
            let ghostingImage = singleImage.cloneNode(true);
            ghostingImage.style.maxWidth = '100%';
            ghostingImage.style.width = '100%';
            ghostingImage.style.maxHeight = '100%';
            ghostingImage.style.height = '100%';
            ghostingImage.style.position = 'absolute';
            ghostingImage.style.objectFit = 'cover';
            ghostingImage.style.zIndex = '1';
            ghostingImage.style.opacity = '0.2';

            singleImage.parentNode.style.position = 'relative';
            singleImage.style.zIndex = '10';
            singleImage.parentNode.appendChild(ghostingImage);
        }
    }
</script>
@endpush
