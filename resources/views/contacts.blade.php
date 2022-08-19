@extends('layouts.main')

@section('content')

<section class="screen">
    <p class="h1-content">Наши контакты </p>
    <div class="container mb-4">
        <div class="row contact-form">
            <div class="col-3">
                <div class="card">
                    <i class="fas fa-phone-alt"></i>
                    <div class="card-body">
                        <h5 class="card-title">Наши номера телефонов</h5>
                    </div>
                    <div class="line mt-1 mb-1"></div>
                    @foreach($settings->phones as $phone)<br>
                        <span class="text-center"><b>{{ $phone->phone }}</b> <br>
                        {{ $phone->description }}</span>
                    @endforeach
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="card-body">
                        <h5 class="card-title">Наш адрес</h5>
                        <p class="card-text">{{$settings->location_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1 mt-1 mb-1"></div>

                    <a href="#">{{$settings->location}}</a>
                </div>
            </div>

            <div class="col-3">
                <div class=" card">
                    <i class="fab fa-vk"></i>
                    <div class="card-body">
                        <h5 class="card-title">Мы в Вконтакте</h5>
                        <p class="card-text">{{$settings->vk_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1"></div>
                    <a href="{{$settings->vk_url}}">Группа вконтакте</a>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <i class="fab fa-telegram-plane"></i>
                    <div class="card-body">
                        <h5 class="card-title">Мы в Телеграм</h5>
                        <p class="card-text">{{$settings->tg_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1"></div>
                    <a href="{{$settings->tg_url}}">Перейти в телеграм</a>
                </div>
            </div>
        </div>
    </div>
</section>
<iframe src="{{$settings->location_url}}" width="100%" height="450" frameborder="0">
</iframe>

@guest
<div class="container">
    <x-registration-form></x-registration-form>
</div>
@endguest
@endsection
