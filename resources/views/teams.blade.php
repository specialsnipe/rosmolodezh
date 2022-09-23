@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@section('content')
<p class="h1-content">Наша команда</p>
<section class="container">
    <div class="row row-cols-1 row-cols-md-2 w-card">
        @foreach($team as $person)
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0 card-height">
                    <div class="col-md-5">
                        <img src="{{asset($person->avatarMediumPath)}}" class="img-teams rounded" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">{{$person->name}}</h5>
                            <div class="line mt-3 mb-3"></div>
                            <p class="card-text">{{$person->description}}</p>
                            <div class="row">
                                <div class="col-3">
                                    @if(isset($person->tg_link))
                                    
                                    <a class="icon text-decoration-none" target="_blank" href="https://t.me/{{ $person->tg_link }}">
                                        <div>
                                            <i class="fa-brands fa-telegram" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    
                                    @endif
                                </div>
                                <div class="col-3">
                                    @if(isset($person->vk_link))
                                    <a target="_blank" href="{{ $person->vk_link }}">
                                        <div class="icon">
                                            <i class="fa-brands fa-vk" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                            </div>
                                @if(isset($person->email))
                                    Почта: {{ $person->email }}
                                @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @endforeach

    </div>
</section>
@guest
<div class="container">
    <x-registration-form></x-registration-form>
</div>
@endguest
@endsection
