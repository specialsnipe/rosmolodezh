@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@section('content')

<section class="screen">
    <p class="h1-content">Наши контакты </p>
    <div class="container mb-4">
        <div class="row contact-form">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <svg style="width:100px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"/></svg>


                    <div class="card-body">
                        <h5 class="card-title">Наши аккаунты в телеграм</h5>
                    </div>
                    @foreach($settings->telegrams as $telegram)<br>
                        <span class="text-center"><a class="text-decoration-none" target="_blank" href="https://t.me/{{ $telegram->username }}"><svg class="pr-2" style="width:30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"/></svg>
                            {{ '@'.$telegram->username }}</a> <br>
                        {{ $telegram->description }}</span>
                    @endforeach
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="card-body">
                        <h5 class="card-title">Наш адрес</h5>
                        <p class="card-text">{{$settings->location_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1 mt-1 mb-1"></div>

                    <a target="_blank" href="https://yandex.ru/search/?text={{ $settings->location }}">{{$settings->location}}</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class=" card">
                    <i class="fab fa-vk"></i>
                    <div class="card-body">
                        <h5 class="card-title">Мы в Вконтакте</h5>
                        <p class="card-text">{{$settings->vk_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1"></div>
                    <a target="_blank" href="{{$settings->vk_url}}">Группа вконтакте</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <i class="fab fa-telegram-plane"></i>
                    <div class="card-body">
                        <h5 class="card-title">Мы в Телеграм</h5>
                        <p class="card-text">{{$settings->tg_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1"></div>
                    <a target="_blank" href="{{$settings->tg_url}}">Перейти в телеграм</a>
                </div>
            </div>
        </div>
    </div>
</section>
<iframe src="{{$settings->location_url}}" style="width:100%; border:0" height="450">
</iframe>

@guest
<div class="container">
    <x-registration-form></x-registration-form>
</div>
@endguest
@endsection
