@push('styles')
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@extends('layouts.main')

@section('content')

    <div class="container mb-5 mt-5">
        <h1 class="h1-content mt-0 mb-4">О нашем проекте</h1>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-3">
                <div class="card content-info">
                    <div class="card-body content-body">
                        <h5 class="card-title">{{ $about->footer_title }}</h5>
                        <p class="card-text">{{ $about->footer_description }}</p>
                    </div>
                    <div class="bg-icon w-100">
                        <div class="phrase-bg-img-about"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 h-100">
                <div class="card content-info h-100">
                    <div class="card-body content-body">
                        <h5 class="card-title">{{$about->company_name}}</h5>
                        <p class="card-text">{!! $about->company_desc !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 h-100">
                <div class="h-100 mt-3">
                    <img src="{{ $about->company_image_medium }}" class="w-100 rounded" alt=""
                         style="object-fit: contain; max-height: 650px">
                </div>
            </div>
            <section class="row fix-adaptiv mt-3 col-md-12">
                <div class="col-md-6 mt-3">
                    <div class="h-100">
                        <img src="{{ $about->company_advantages_image_medium }}" class="w-100 rounded" alt=""
                             style="object-fit: contain; max-height: 650px">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card content-info-1">
                        <div class="card-body content-body">
                            <h5 class="card-title">{{$about->company_advantages_title}}</h5>
                            @forelse($advantages as $advantage)
                                <p class="card-text">{{$advantage->description}}</p>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
            <div class="col-md-6">
                <img src="{{ $about->company_grant_image_medium }}" class="w-100 rounded mt-3" alt=""
                     style="object-fit: contain; max-height: 650px">
            </div>

            <div class="col-md-6">
                <div class="card content-info-2">
                    <div class="card-body content-body">
                        @forelse($grants as $grant)
                            <h5 class="card-title">{{ $grant->title }}</h5>
                            <p class="card-text">{{ $grant->description }}</p>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card content-info-3">
                    <div class="card-body content-body row">
                        @forelse($competitions as $competition)
                            <div class="col-md-6 ">
                                <h5 class="card-title">{{$competition->title}}</h5>
                                <p class="card-text">{{$competition->description}}</p>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="row d-flex justify-content-center mt-1">

            <div class="col-md-6">
                <div class="card content-info">

                <div class="card-body content-body">

                    <h5 class="card-title"></h5>
                    <p class="text-about text-truncated card-text">

                    </p>

                    <a class="show-more"><span class="button-text">Подробнее</span> <i class="fa fa-angle-up reverse"></i></a>
                </div>

                <div class="bg-icon w-100">
                    <div class="phrase-bg-img-2"></div>
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card content-info">

                <div class="card-body content-body">

                    <h5 class="card-title">Пока что нам нечего вам покаазть</h5>
                    <p class="text-about text-truncated card-text">
                    </p>

                    <a class="show-more"><span class="button-text">Подробнее</span> <i class="fa fa-angle-up reverse"></i></a>

                </div>

                <div class="bg-icon w-100">
                    <div class="phrase-bg-img-2"></div>
                </div>
                </div>
            </div>

        </div> -->
    </div>

    @guest
        <section class="container">
            <x-registration-form></x-registration-form>
        </section>
    @endguest
@endsection

