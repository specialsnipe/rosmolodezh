@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@section('content')

<section class="screen">
    <p class="h1-content">Наши контакты </p>
    <div class="container mb-4">
        <div class="row contact-form">


            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="card-body">
                        <h5 class="card-title">Наш адрес</h5>
                        <p class="card-text">{{$settings->location_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1 mt-1 mb-1"></div>

                    <a target="_blank"
                        href="https://yandex.ru/search/?text={{ $settings->location }}">{{$settings->location}}</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4">
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

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="66" height="66" viewBox="0 0 56 56" fill="none" style="margin-top: .6rem;">
                        <path
                            d="M0 28C0 12.536 12.536 0 28 0C43.464 0 56 12.536 56 28C56 43.464 43.464 56 28 56C12.536 56 0 43.464 0 28Z"
                            fill="black" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M27.4334 0C27.3011 11.5194 26.5478 17.9662 22.257 22.257C17.9662 26.5478 11.5194 27.3011 0 27.4334V29.1051C11.5194 29.2373 17.9662 29.9906 22.257 34.2814C26.4805 38.5049 27.2766 44.8173 27.4267 56H29.1118C29.2618 44.8173 30.0579 38.5049 34.2814 34.2814C38.5049 30.0579 44.8173 29.2618 56 29.1118V27.4266C44.8173 27.2766 38.5049 26.4805 34.2814 22.257C29.9906 17.9662 29.2373 11.5194 29.1051 0H27.4334Z"
                            fill="white" />
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title">Мы в Дзене</h5>
                        <p class="card-text">{{$settings->zen_description}}</p>
                    </div>
                    <div class="line mt-1 mb-1"></div>
                    <a target="_blank" href="{{$settings->zen_url}}">Перейти в Дзен</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 ">
                <div class="card mt-3">
                    <i class="fab fa-telegram-plane" aria-hidden="true"></i>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Наши аккаунты в телеграм</h5>
                    </div>
                    <div class="row">
                        @foreach($settings->telegrams as $telegram)
                        <div class="col">
                            <a class="text-decoration-none" target="_blank"
                            href="https://t.me/{{ $telegram->username }}">
                            <div class="card " style="height: 120px !important">
                                <span class="text-center">
                                    <svg class="pr-2"
                                            style="width:30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path
                                                d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z" />
                                        </svg>
                                        {{ '@'.$telegram->username }}
                                    {{ $telegram->description }}</span>
                            </div>
                        </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6 ">
                <div class="card mt-3">
                    <i class="fa-solid fa-envelope" aria-hidden="true"></i>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Наши почтовые ящики</h5>
                    </div>
                    <div class="row">
                        @foreach($settings->telegrams as $telegram)
                        <div class="col">
                            <a class="text-decoration-none" target="_blank"
                            href="https://t.me/{{ $telegram->username }}">
                            <div class="card " style="height: 120px !important">
                                <span class="text-center">
                                        <svg class="pr-2"
                                            style="width:25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path
                                                d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                            </svg>
                                        {{ '@'.$telegram->username }}
                                    {{ $telegram->description }}</span>
                            </div>
                        </a>
                        </div>
                        @endforeach
                    </div>
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
