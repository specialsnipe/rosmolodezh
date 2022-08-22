@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing-slider.css') }}">

@endpush
@section('content')



<section class="container p-0 mt-3">

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
    <div class="container  p-0 ">
        <div class="row cards-with-text">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card-text-main d-flex align-items-center justify-content-center m-0 m-sm-2">"Будь умнее и умней с нами
                    каждый день!"</div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card-text-main d-flex align-items-center justify-content-center m-0">"3 000 успешных
                    программистов с ОВЗ"</div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card-text-main d-flex align-items-center justify-content-center m-0">"Почему именно мы? Потому
                    что мы профессионалы своего дела."</div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card-text-main d-flex align-items-center justify-content-center m-0">"Быть умнее других не
                    зазорно!"</div>
            </div>
        </div>
    </div>
</section>

<section class="screen news-blocks">
    <div class="container p-0">
        <h2 class="text-light d-flex justify-content-center w-100 mt-2 mb-4">Все направления</h2>
        <div class="row">
            @foreach ($tracks as $track)
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card card-track d-flex flex-column justify-content-between">

                    <a href="{{ route('tracks.show', $track->id) }}">
                        <img src="{{ asset($track->image_original ) }}" class="card-img-top rounded" alt="...">
                    </a>
                    <a href="{{ route('tracks.show', $track->id) }}" class="card-footer">
                        <div class="">{{ $track->title }}</div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>


        <div class="mt-2 d-flex justify-content-center">
            <p>
                Тект для того чтобы пояснить что вообще зачем тут это и всё
            </p>
        </div>
    </div>
    </div>
    </div>
</section>
<section>
    <div class="container p-0">
        <h2 class="mt-4 mb-4"> Последние новости</h2>
        <x-index-post></x-index-post>
        <a href="{{ route('posts.index') }}" class="btn w-100">Все новости</a>
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
