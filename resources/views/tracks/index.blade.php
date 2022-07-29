@extends('layouts.main')

@push('styles')
    <style>.cards-wrapper {
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
        width: 350px;
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
        .card {
            width: 65%;

        }
    }</style>
@endpush

@section('content')
<p class="h1-content">Наши направления</p>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
    <div class="carousel-inner">
        <div class="carousel-item active col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="cards-wrapper">
                @foreach ($tracks as $track )

                <div class="card">
                    <img src="images/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk
                            of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Следующий</span>
    </button>
</div>
@guest
<x-registration-form></x-registration-form>
@endguest
@endsection
