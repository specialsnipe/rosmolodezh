@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing-slider.css') }}">
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush
@section('content')



<section class="container p-0 mt-4">

    <div class="slider">
        <div class="slider__wrapper">
            <div class="slider__items">
                @foreach ($slides as $slide)
                <div class="slider__item">
                    <div class="slide__img">
                        <a>
                            <img class="img-fluid" src="{{ $slide->img_url }}" alt="">
                        </a>
                    </div>
                    <div class="slide__text">
                        <h3>{{ $slide->title }}</h3>
                        <span>{!! $slide->body !!}</span>
                        <a target="_blank" href="{{ $slide->button_link }}" class="btn btn-primary">{!!
                            $slide->button_name !!}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="screen phrases-screen p-4">
    <div class="container p-0">
        <div class="row">
            @foreach ($phrases as $phrase)
            <div class="col-sm-12
            @if($phrases_count == 1)
            col-md-12 @else
            col-md-6 @endif
            @if($phrases_count > 3)
            col-lg-3 @elseif($phrases_count == 3)
            col-lg-4 @elseif($phrases_count == 2)
            col-lg-6 @elseif($phrases_count == 1)
            col-lg-12 @endif
            ">
                <div class="card-text-main d-flex align-items-center justify-content-center m-0 mb-4"><span>{{ $phrase->body }}</span>
                    <svg width="393" height="216" viewBox="0 0 393 216" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M307.721 327.127C370.182 310.391 423.437 269.527 455.769 213.526C488.102 157.524 496.864 90.9725 480.127 28.511C463.391 -33.9504 422.527 -87.205 366.526 -119.537C310.524 -151.87 243.972 -160.631 181.511 -143.895C119.05 -127.159 65.795 -86.2948 33.4626 -30.2934C1.13021 25.7079 -7.63149 92.2596 9.10499 154.721C25.8415 217.182 66.7052 270.437 122.707 302.769C178.708 335.102 245.26 343.864 307.721 327.127V327.127ZM203.345 55.3458C209.876 79.7212 201.989 103.038 185.738 107.392C169.488 111.747 150.999 95.4975 144.467 71.1221C137.936 46.7467 145.824 23.4299 162.074 19.0756C178.324 14.7214 196.814 30.9704 203.345 55.3458ZM147.611 167.051C150.469 164.193 154.345 162.588 158.386 162.588C162.428 162.588 166.304 164.193 169.162 167.051C182.402 180.3 198.899 189.827 216.992 194.672C235.085 199.517 254.135 199.511 272.224 194.652C290.32 189.815 306.821 180.296 320.067 167.053C333.314 153.81 342.837 137.311 347.679 119.217C348.186 117.273 349.073 115.448 350.289 113.847C351.504 112.247 353.024 110.903 354.761 109.892C356.498 108.881 358.418 108.224 360.41 107.959C362.402 107.693 364.427 107.824 366.368 108.344C368.31 108.865 370.129 109.764 371.721 110.99C373.313 112.216 374.647 113.745 375.647 115.488C376.646 117.232 377.29 119.156 377.542 121.15C377.795 123.144 377.65 125.168 377.117 127.106C370.891 150.367 358.647 171.578 341.618 188.604C324.589 205.629 303.375 217.869 280.113 224.091C256.856 230.334 232.364 230.341 209.104 224.111C185.844 217.88 164.635 205.633 147.612 188.601C144.754 185.744 143.148 181.868 143.148 177.826C143.148 173.785 144.754 169.909 147.611 167.051ZM303.494 75.8398C287.244 80.194 268.754 63.945 262.223 39.5696C255.691 15.1942 263.579 -8.12261 279.829 -12.4769C296.08 -16.8311 314.569 -0.58206 321.1 23.7933C327.632 48.1687 319.744 71.4855 303.494 75.8398Z" />
                    </svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="screen news-blocks">
    <div class="container p-0">
        <h2 class="text-light d-flex justify-content-center w-100 mt-2 mb-4">Все направления</h2>
        <div class="row">
            @foreach ($tracks as $track)
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card card-track d-flex flex-column justify-content-between mb-4">

                    <a target="_blank" href="{{ route('tracks.show', $track->id) }}">
                        <img src="{{ asset($track->image_original ) }}" class="card-img-top rounded" alt="...">
                    </a>
                    <a target="_blank" href="{{ route('tracks.show', $track->id) }}" class="card-footer">
                        <div class="">{{ $track->title }}</div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>


        <div class="mt-2 d-flex justify-content-center">
            <p>
                Текcт для того чтобы пояснить что вообще зачем тут это и всё
            </p>
        </div>
    </div>
</section>

<section>
    <div class="container latest-posts p-0">
        <h2 class="mt-4 mb-4"> Последние новости</h2>
        <x-index-post></x-index-post>
        <a href="{{ route('posts.index') }}" class="btn w-100 mb-4">Все новости</a>
    </div>
</section>
@guest
<section class="container">
<x-registration-form></x-registration-form>
</section>
@endguest
@endsection


@push('script')

<script src="{{  asset('scripts/simple-adaptive-slider.min.js') }}"></script>
<script defer>
    let sliderblock = document.querySelector('.slider');
        if (sliderblock) {
            var slider = new SimpleAdaptiveSlider('.slider', {
                loop: false,
                autoplay: false,
                interval: 2000,
                swipe: true,
            });
        }
</script>
@endpush
