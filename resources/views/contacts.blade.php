@extends('layouts.main')

@section('content')

    <section>
        <p class="h1-content">Наши контакты </p>
        <div class="news-block contact-form container-fluid mb-4">
            <div class="card-form row d-flex justify-content-between">

                <div class="card">
                    <i class="fas fa-phone-alt"></i>
                    <div class="card-body">
                        <h5 class="card-title">Наш номер телефон</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                    <div class="line"></div>
                    <a href="tel:+78005553535"> 8-800-555-35-35 </a>
                </div>

                <div class="card">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="card-body">
                        <h5 class="card-title">Наш адрес</h5>
                        <p class="card-text">{{$settings->location_description}}</p>
                    </div>
                    <div class="line"></div>

                    <a href="#">{{$settings->location}}</a>
                </div>

                <div class=" card">
                    <i class="fab fa-vk"></i>
                    <div class="card-body">
                        <h5 class="card-title">Мы в Вконтакте</h5>
                        <p class="card-text">{{$settings->vk_description}}</p>
                    </div>
                    <div class="line"></div>
                    <a href="{{$settings->vk_url}}">Группа вконтакте</a>
                </div>
                <div class="card">
                    <i class="fab fa-telegram-plane"></i>
                    <div class="card-body">
                        <h5 class="card-title">Мы в Телеграм</h5>
                        <p class="card-text">{{$settings->tg_description}}</p>
                    </div>
                    <div class="line"></div>
                    <a href="{{$settings->tg_url}}">Перейти в телеграм</a>
                </div>
            </div>
        </div>
    </section>
    <iframe
        src="{{$settings->location_url}}"
        width="100%" height="450" frameborder="0">
    </iframe>

    @guest
        <x-registration-form></x-registration-form>
    @endguest
@endsection

