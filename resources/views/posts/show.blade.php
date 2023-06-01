@php
    use Carbon\Carbon;
    use app\Models\Post;

    /**
    * @var Post $post
    */
@endphp

@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
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
                                                <img src="{{ $image->imageMedium }}" class="w-100 rounded" alt=""
                                                    style="object-fit: contain; max-height: 650px">
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
                                <img src="{{ asset($post->images[0]->imageMedium) }}" class="rounded single-image"
                                    alt="" style="object-fit: contain; max-height: 650px; max-width: 100%">
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-4  d-lg-block d-md-none d-sm-none d-none">
                        <div class="">
                            <div class="h2">Другие интересные статьи</div>
                            <div class="line mt-3 mb-0"></div>
                            <div class="link-content">
                                @foreach ($posts as $postx)
                                    <a href="{{ route('posts.show', $postx->slug) }}" class=""
                                        style="text-decoration: none">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <p class="h5 mb-2" style="text-decoration: none"><i
                                                        class="fas fa-external-link-alt"
                                                        style="font-size: 16px;"></i> {{ $postx->title }} </p>
                                                <span class="text-truncat-1 text-black">{{ $postx->excerpt }} </span>
                                                <span class="card-text post__card-text"
                                                    style="font-size: 13px; color: #ababab">дата: {{ Carbon::parse($postx->created_at)->format("Y/m/d") }}</span>
                                            </div>
                                        </div>
                                    </a>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 body">
                    <p class="card-text post__card-text" style="font-size: 13px; color: #ababab">
                        дата: {{ Carbon::parse($post->created_at)->format("Y/m/d") }}</p>
                    <span class="h2">{{ $post->title }}</span>
                    <p class="mt-3 mb-3">{!! $post->body !!}</p>
                    @if($post->video)
                        <video src="{{ $post->video_src }}" controls class="post__video" style="width: 100%"></video>
                    @endif
                </div>
                <div class="col-sm-12  d-lg-none d-md-block">
                    <div class="">
                        <div class="h2">Другие интересные статьи</div>
                        <div class="line mt-3 mb-0"></div>
                        <div class="link-content">
                            @foreach ($posts as $postx)
                                <a href="{{ route('posts.show', $postx->slug) }}" class="">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <span class="card-text post__card-text"
                                                style="font-size: 13px; color: #ababab">дата: {{ Carbon::parse($postx->created_at)->format("Y/m/d") }}</span>

                                            <p class="h5"><i class="fas fa-external-link-alt"
                                                    style="font-size: 16px;"></i> {{ $postx->title }} </p>
                                            <p class="text-truncat-1 ">{{ $postx->excerpt }} </p>
                                        </div>
                                    </div>
                                </a>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="new_modal" style="max-width: 100% !important">
                <div class="slider__wrapper">
                    <div class="slider__items">

                    </div>

                    <a class="slider__control slider__control_prev" href="#" role="button"
                        data-slide="prev"></a>
                    <a class="slider__control slider__control_next" href="#" role="button"
                        data-slide="next"></a>
                </div>
            </div>
            <div class="new_overlay" id="overlay-modal"></div>
            @guest
                <div class="screen register-screen">
                    <x-registration-form></x-registration-form>
                </div>
            @endguest
        </div>
    </div>

@endsection
@push('script')
    <script src="{{  asset('scripts/simple-adaptive-slider.min.js') }}"></script>
    <script defer>

        const spans = document.querySelectorAll('span');
        const p = document.querySelectorAll('p');

        spans.forEach(span => {
            span.style.fontFamily = '';
        });

        p.forEach(tag => {
            tag.style.fontFamily = '';
            let imgs = tag.querySelectorAll("img");
            imgs.forEach(img => {
                img.style.width = '100%';
                img.style.borderRadius = '10px';
                img.style.marginTop = '20px';
            });
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

        let images = document.querySelectorAll('.body img');
        let modal = document.querySelector('.new_modal');
        let modalItems = document.querySelector('.slider__items');


        let overlay = document.querySelector('.new_overlay');
        images.forEach((image) => {
            let div = document.createElement('div');
            div.classList.add('slider__item');
            div.append(image.cloneNode(true));
            modalItems.append(div.cloneNode(true));

        });
        let sliderBlock = document.querySelector('.new_modal');
        if (sliderBlock) {
            const slider = new SimpleAdaptiveSlider('.new_modal', {
                loop: true,
                autoplay: false,
                interval: 5000,
                swipe: true,
            });
        }
        console.log(modalItems);
        overlay.addEventListener('click', function (event) {
            event.preventDefault();
            if (event.target === overlay) {
                overlay.classList.remove('active');
                modal.classList.remove('active');
            }
        });
        images.forEach((image) => {
            image.addEventListener('click', function (event) {
                event.preventDefault();
                overlay.classList.add('active');
                modal.classList.add('active');
            });
        });
    </script>
@endpush
