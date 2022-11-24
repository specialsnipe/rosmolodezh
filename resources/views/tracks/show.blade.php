@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@push('seo')
    {!! seo()->for($track) !!}
@endpush
@extends('layouts.main')


@section('content')
    <div class="screen screen-directions">
        <div class="container">
            <div class="main-container-directions">
                <div class="container row m-0 p-0">
                    <div class="col-sm-12 col-md-6 pl-0">
                        <h1 class="h1">{{ $track->title }}</h1>@auth
                            @if( auth()->user()->tracks->where('id', $track->id)->first() ? true : false)
                                <span class="badge fs-8 bg-secondary"> Вы являетесь участником</span>
                            @endif
                            @endauth
                        <img class="rounded w-100" src="{{ asset($track->imageMedium) }}" alt="">
                    </div>
                    <div class="col-sm-12 col-md-6 pr-0">
                        <div class="flex-container">
                            <div class="text-container">
                                <h1 class="h2">О направлении:</h1>
                                <p class="fs-6">{{ $track->body }}</p>
                                <p class="fs-6">Количество блоков: <span
                                        class="badge large bg-primary">{{ $track->blocksCount }}</span></p>
                                <p class="fs-6">Количество заданий: <span
                                        class="badge large bg-primary">{{ $track->exercisesCount }}</span></p>
                                <p class="fs-6">Количество часов: <span
                                        class="badge large bg-primary">{{ $track->hoursCount }}</span></p>

                                @if (isset(auth()->user()->role_id) && auth()->user()->role_id == 1)

                                @auth
                                @if( auth()->user()->tracks->where('id', $track->id)->first() ? true : false)
                                    @if($requestToRefuseSended)
                                        <span class="btn btn-secondary">Был отправлен запрос на отмену участия</span>
                                    @elseif(!$requestToRefuseSended)
                                        </span></p>
                                        <form action="{{ route('tracks.sendRefuseRequest', $track->id) }}" method="post"
                                            style="display: inline">
                                            @csrf
                                            <button class="btn btn-primary" type="submit"> Отправить запрос на отмену участия</button>
                                        </form>
                                    @endif
                                @else
                                    @if($requestToJoinSended)
                                        <span class="btn btn-secondary">Был отправлен запрос на участие</span>
                                    @elseif(!$requestToJoinSended)
                                        <form action="{{ route('tracks.sendRequest', $track->id) }}" method="post"
                                            style="display: inline">
                                            @csrf
                                            <button class="btn btn-primary" type="submit"> Отправить запрос на участие</button>
                                        </form>
                                    @endif
                                @endif
                                @endauth
                                @endif


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
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <h2 class="d-flex justify-content-center w-100 mt-2 mb-4">Содержание направления:</h2>

                    @foreach ($track->blocks as $block)
                            <div class="card mb-2">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-10">
                                            <p class="fs-5">
                                                {{ $block->title }}
                                            </p>
                                            <p class="fs-6 mb-0">
                                                Заданий: {{ $block->exercises_count }}
                                            </p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <h2 class="d-flex justify-content-center w-100 mt-2 mb-4">Другие направления</h2>

                    @foreach ($tracks as $track)
                            <div class="col-12">
                                <div class="card d-flex flex-column justify-content-between mb-4">

                                    <a target="_blank" href="{{ route('tracks.show', ['track' => $track->slug]) }}">
                                        <img src="{{ asset($track->imageNormal ) }}" class="card-img-top" alt="...">
                                    </a>
                                    <a target="_blank" href="{{ route('tracks.show', ['track' => $track->slug]) }}" class="card-footer track-title bg-primary-light">
                                        <div>{{ $track->title }}</div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="container p-0">
                        @guest
                            <div class="screen register-screen">
                                <x-registration-form></x-registration-form>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    @guest

    @endguest

@endsection
