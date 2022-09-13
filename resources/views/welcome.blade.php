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

<div class="screen phrases-screen p-4">
    <div class="container p-0">
        <div class="row">
            @foreach ($phrases as $phrase)
            <div class="col-sm-12 {{ $phraseSize }}">
                <div class="card-text-main d-flex align-items-center justify-content-center m-0 mb-4 {{ $phraseBG }}">
                    <span>{{$phrase->body }}</span>
                    <div class="phrase-bg-img" style="transition:200ms;position: absolute;width: 50%; height: 150%; color: hsl(0 0% 0%/0.2); right:-20px; transform: rotate(-30deg)">
                        <?xml version="1.0" ?><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"  style="fill:hsl(0 0% 0%/0.1);transition:200ms"><title/><path d="M23.344,3.168A1.65,1.65,0,0,0,21.9,2.9c-2.272.649-5.355,2.136-9.371-.333A10.343,10.343,0,0,0,4.053,1.5L3,1.882V1.5a1.5,1.5,0,0,0-3,0v21a1.5,1.5,0,0,0,3,0v-4c7.912-2.882,8.259,2,14.42,2,1.724,0,1.971-.294,5.383-1.269A1.655,1.655,0,0,0,24,17.644V4.485A1.657,1.657,0,0,0,23.344,3.168ZM19.53,11.031l-3,3a.75.75,0,1,1-1.06-1.061l2.469-2.47L15.47,8.031A.75.75,0,1,1,16.53,6.97l3,3A.75.75,0,0,1,19.53,11.031ZM14.212,7.738l-2,6a.751.751,0,0,1-1.424-.475l2-6a.751.751,0,1,1,1.424.475ZM9.53,12.97a.75.75,0,0,1-1.06,1.061l-3-3a.75.75,0,0,1,0-1.061l3-3A.75.75,0,0,1,9.53,8.031L7.06,10.5Z"/></svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<section class="screen news-blocks">
    <div class="container p-0">
        <h2 class="dark-text d-flex justify-content-center w-100 mt-2 mb-4">Все направления</h2>
        <div class="row">
            @foreach ($tracks as $track)
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card card-track d-flex flex-column justify-content-between mb-4">

                    <a target="_blank" href="{{ route('tracks.show', $track->id) }}">
                        <img src="{{ asset($track->imageNormal ) }}" class="card-img-top rounded"
                            alt="{{ $track->title }}">
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
<div class="container">
    <x-registration-form></x-registration-form>
</div>
@endguest
@endsection


@push('script')

<script src="{{  asset('scripts/simple-adaptive-slider.min.js') }}"></script>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        let sliderblock = document.querySelector('.slider');
        if (sliderblock) {
            var slider = new SimpleAdaptiveSlider('.slider', {
                loop: false,
                autoplay: false,
                interval: 2000,
                swipe: true,
            });
        }
    }
</script>
@endpush
