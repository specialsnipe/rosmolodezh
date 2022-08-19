@php
    use App\Models\Track;

    $tracks = Track::limit(3)->get();
@endphp

@extends('layouts.main')

@section('content')
<div class="screen screen-directions">
    <div class="main-container-directions">

        <div class="container row m-0 p-0">
            <div class="col-sm-12 col-md-6">
                    <img src="{{ asset($track->url_image_original) }}" alt="">
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="flex-container">
                    <div class="text-container">
                        <p class="text-h1">Куратор направления</p>
                        <div class="line"></div>
                        <p class="text-h2">О кураторе:</p>
                        <ul>
                            <li>
                                <p>{{ $track->curator->all_names }}</p>
                            </li>
                            <li>
                                <p>{{$track->curator->curator_job}}</p>
                            </li>
                            <li>
                                <p>{{$track->curator->curator_about}}</p>
                            </li>
                        </ul>

                        <p class="text-h2">Социальные сети куратора:</p>
                        <div class="line"></div>
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
            <h4>Другие направления</h4>
            <div class="cards-track">


                @foreach ($tracks as $track)
                <div class="card col-md-3 col-lg-3 col-sm-12  d-flex flex-column justify-content-between">

                    <a href="{{ route('tracks.show', $track->id) }}">
                        <img src="{{ asset($track->image_original )  }}" class="card-img-top" alt="...">
                    </a>
                    <a href="{{ route('tracks.show', $track->id) }}" class="card-footer">
                        <div class="">{{ $track->title }}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="screen register-screen">
            <x-registration-form></x-registration-form>
        </div>
    </div>
</div>
@guest

@endguest

@endsection
