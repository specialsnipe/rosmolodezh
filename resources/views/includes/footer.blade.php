
@php
use App\Models\Information;
    $information = Information::all()[0];
@endphp
<div class="footer-block container">
    <a href="{{ route('home') }}" class=" logo" >
        <img src="images/logo.png" alt="">
    </a>

    <div class="right-side">
        <div class="line-top"></div>
        <div class="links-footer">
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О проекте</a>
            <a href="{{ route('tracks.index') }}">Направления</a>
            <a href="{{ route('posts.index') }}">Новости</a>

            <a href="{{ route('teams') }}">Команда</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            @auth
            <a href="{{ route('auth.logout') }}">Выход</a>
            @else
            <a href="{{ route('auth.login') }}">Авторизация</a>
            <a href="{{route('auth.register')}}">Регистрация</a>
            @endauth
        </div>
    </div>

    <div class="icons">

        <div class="icon">
            <a target="_blank" href="{{ $information->vk_url }}"><i class="fab fa-vk"></i></a>
        </div>
        <div class="icon">
            <a target="_blank" href="https://t.me/{{ $information->tg_url }}"><i class="fab fa-telegram-plane"></i></a>
        </div>
        <div class="icon">
            <a target="_blank" href="{{ $information->zen_url }}"><i class="fas fa-phone-alt"></i></a>

        </div>

    </div>
</div>
