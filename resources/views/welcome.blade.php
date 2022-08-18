@extends('layouts.main')

@section('content')



<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
    <!-- <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div> -->
    <div class="carousel-inner">
        @foreach ($posts as $post)
            <div class="carousel-item @if($loop->first) active @endif">
                <img src="{{ asset($post->images['0']->original_image) }}" class="d-block w-100" height="500" alt="...">
                <a href="{{ route('posts.show', $post->id) }}" style="text-decoration: none" class="carousel-caption d-none d-md-block transparent-elem">
                    <h5>{{ $post->title }}</h5>
                    <p>{{ $post->excerpt }}</p>
                </a>
            </div>
        @endforeach
        {{-- <div class="carousel-item">
            <img src="images/2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block transparent-elem">
                <h5>Метка второго слайда</h5>
                <p>Некоторый репрезентативный заполнитель для второго слайда.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block transparent-elem">
                <h5>Метка третьего слайда</h5>
                <p>Некоторый репрезентативный заполнитель для третьего слайда.</p>
            </div>
        </div> --}}
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

<section class="container-xxl mt-4">
    <div class="row cards-with-text">
        <div class="col-sm col-md-6 col-lg-3">
            <div class="card-text-main d-flex align-items-center justify-content-center">"3 000 успешных программистов с
                ОВЗ"</div>
        </div>
        <div class="col-sm col-md-6 col-lg-3">
            <div class="card-text-main d-flex align-items-center justify-content-center">"3 000 успешных программистов с
                ОВЗ"</div>
        </div>
        <div class="col-sm col-md-6 col-lg-3">
            <div class="card-text-main d-flex align-items-center justify-content-center">"3 000 успешных программистов с
                ОВЗ"</div>
        </div>
        <div class="col-sm col-md-6 col-lg-3">
            <div class="card-text-main d-flex align-items-center justify-content-center">"3 000 успешных программистов с
                ОВЗ"</div>
        </div>
    </div>
</section>

<section class="news-blocks container-fluid mt-4">
    <div class="block">
        <div class="row directions-block ">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Посмотреть все направления
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="row d-flex justify-content-evenly">
                            @foreach ($tracks as $track)

                            <div class="card col-md-3 col-lg-3 col-sm-12 ">
                                <a href="{{ route('tracks.show', $track->id) }}" class="card-title">
                                <img src="/images/card-images-1.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    {{ $track->title }}
                                    </div>

                                </a>
                            </div>

                                <!-- <a href="{{ route('tracks.show', $track->id) }}" class="direction col-md-3 d-flex align-items-center justify-content-center"> {{ $track->title }} </a> -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-2 d-flex justify-content-center">
            <p>
                Мы не рекомендуем использовать для разметки материалов системы управления тегами — в этом случае Метрика
                не
                сможет корректно
                обработать размеченные данные. Но такие системы можно использовать для других целей, например, для
                установки
                счетчика на сайт.
                Все размеченные сущности Schema.org должны быть внутри тега body. Если на странице несколько материалов,
                каждый из них должен
                быть размечен отдельно.
            </p>
        </div>
    </div>
    </div>
    </div>
</section>
<section>
    <div class="news-block container-fluid">
        <h2 class="mt-4 mb-4"> Последние новости</h2>
        <x-index-post></x-index-post>
        <a href="{{ route('posts.index') }}" class="btn mb-5">Все новости</a>
    </div>
</section>
@guest
<x-registration-form></x-registration-form>
@endguest
@endsection

