@extends('layouts.main')

@push('styles')

@endpush

@section('content')
<div class="container main-container-directions">
    <div class="images-header">
        <img src="{{ asset($track->url_image_original) }}" alt="">
        <a href="{{ url()->previous() }}" class="btn-back">Назад</a>
    </div>
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
@guest
<x-registration-form></x-registration-form>
@endguest
@endsection
