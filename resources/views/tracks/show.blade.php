@php
    use App\Models\Track;

    $tracks = Track::all()->random(3);
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@extends('layouts.main')

@section('content')
<div class="screen screen-directions">
    <div class="container">
        <div class="main-container-directions">
            <div class="container row m-0 p-0">
                <div class="col-sm-12 col-md-6 pl-0">
                    <h1 class="h1">{{ $track->title }}</h1>
                    <img class="w-100" src="{{ asset($track->url_image_original) }}" alt="">
                </div>
                <div class="col-sm-12 col-md-6 pr-0">
                    <div class="flex-container">
                        <div class="text-container">
                            <h1 class="h2">О направлении:</h1>
                            <p class="fs-5">{{ $track->body }}</p>
                            <p class="fs-5">Количество блоков: <span class="badge large bg-primary">{{ $track->blocks_count }}</span></p>
                            <p class="fs-5">Количество заданий: <span class="badge large bg-primary">{{ $track->exercises_count }}</span></p>
                            <p class="fs-5">Количество часов: <span class="badge large bg-primary">{{ $track->hours_count }}</span></p>

                            <div class="line mt-3 mb-3"></div>

                            <h1 class="h2">Куратор направления:</h1>
                            <p class="fs-5">{{ $track->curator->all_names }}</p>

                            @if(isset($track->curator->curator_job) || isset($track->curator->curator_about))
                                <h2 class="h2">О кураторе:</h2>
                                <ul>
                                    @if(isset($track->curator->curator_job))
                                    <li>
                                        <p>{{$track->curator->curator_job}}</p>
                                    </li>
                                    @endif
                                    @if(isset($track->curator->curator_about))
                                    <li>
                                        <p>{{$track->curator->curator_about}}</p>
                                    </li>
                                    @endif
                                </ul>
                            @endif
                            <div class="line mt-3 mb-3"></div>

                            <h2 class="h2">Социальные сети куратора:</h2>
                            <div class="link-row">
                                <a href="{{ $track->curator->vk_url }}" class="icon">
                                    <i class="fab fa-vk"></i>
                                </a>

                                <a href="{{ 'https://t.me/'. $track->curator->tg_name }}" class="icon">
                                    <i class="fab fa-telegram-plane"></i>
                                </a>
                                <a href="" class="icon">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="container">
                <h2 class="d-flex justify-content-center w-100 mt-2 mb-4">Другие направления</h2>
                <div class="row">
                    @foreach ($tracks as $track)
                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="card card-track d-flex flex-column justify-content-between mb-4">

                            <a target="_blank" href="{{ route('tracks.show', $track->id) }}">
                                <img src="{{ asset($track->image_original ) }}" class="card-img-top rounded" alt="...">
                            </a>
                            <a target="_blank" href="{{ route('tracks.show', $track->id) }}" class="card-footer bg-primary">
                                <div class="">{{ $track->title }}</div>
                            </a>
                        </div>
                    </div>
                    @endforeach

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
@guest

@endguest

@endsection
