@extends('layouts.main')

@push('styles')

<link rel="stylesheet" href="{{ asset('css/media.css') }}">


<style>
    .cards-wrapper {
        display: flex;
        justify-content: center;
    }

    .card img {
        max-width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
    }

    .card {
        margin: 0 0.5em;
        height: 650px;
        border: none;
        border-radius: 15px;

    }

    .carousel-inner {
        padding: 1em;
    }

    .carousel-control-prev,
    .carousel-control-next {
        background-color: #161616;
        width: 5vh;
        height: 5vh;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
    }

    @media (min-width: 768px) {
        .card img {
            height: 400px;
        }
    }

    .carousel-inner p {
        height: 120px;
    }


    .carousel {
        width: 1300px;
        margin: 0 auto;

    }

    @media (max-width: 768px) {
        .card img {
            min-height: 200px;
        }

        .carousel {
            width: auto;
        }

        .card {
            width: 95%;
            height: auto;
        }
    }

    @media (min-width: 768px) and (max-width: 1280px) {
        .carousel {
            width: auto;
            margin: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <p class="h1-content">Наши направления</p>
    <div class="row">
        @foreach ($tracks as $track )
        <div class="col-sm-12 col-md-6 col-xl-4 mb-4">
            <div class="card">
                <img src="{{ asset($track->url_image_original) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $track->title }}</h5>
                    <p class="card-text">{{ $track->body }}</p>
                    <a href="{{ route('tracks.show', $track->id) }}" class="btn">Подробнее...</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@guest
<div class="container">
    <x-registration-form></x-registration-form>
</div>
@endguest
@endsection
