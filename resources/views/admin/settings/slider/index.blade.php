@extends('admin.layouts.main')

@push('style')

<link rel="stylesheet" href="{{ asset('css/simple-adaptive-slider.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/landing-slider.css') }}">
@endpush

@section('content')

<div class="content-wrapper" style="padding-top: 1rem">
    <!-- Content Header (Page header) -->
    <div class="row d-flex justify-content-between mr-3 ml-3">
        <div class="col-sm-6">
            <h1 class="">Слайдер на главной странице</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                <li class="breadcrumb-item active">Слайды на главной странице</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->



    <div class="row m-3">

        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
            <a href="{{route('admin.settings.slider.create')}}" class="btn btn-block btn-primary">Добавить новый слайд</a>
        </div>
    </div>
    <div class="row m-3">

        <div class="col-sm-12 col-md-6">
           <div class="card">
            <div class="card-body">
                <div class="slider">
                    <div class="slider__wrapper">
                        <div class="slider__items">
                            @foreach ($slides as $slide)
                            <div class="slider__item">
                                <div class="slide__img">
                                    <img class="img-fluid" src="{{ $slide->img_url }}" alt="">
                                </div>
                                <div class="slide__text">
                                    <h3>{{ $slide->title }} <a href="{{ route('admin.settings.slider.edit', $slide->id) }}" class="btn btn-outline-secondary"> <i class="fa fa-pen"></i></a></h3>
                                    <span>{!! $slide->body !!}</span>
                                    <a target="_blank" href="{{ $slide->button_link }}" class="btn btn-primary">{!! $slide->button_name !!}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
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
