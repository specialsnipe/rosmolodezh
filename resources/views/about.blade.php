
@php
use App\Models\Track;

$tracks = Track::all();
@endphp

@extends('layouts.main')

@section('content')

<p class="h1-content">О нашем проекте </p>
<section class="counter-block">
    <div class="cunter-content">
        <div class="block-info-right">
            <p class="text-h1">Конкурс</p>
            <p class="mb-3">Первый конкурс 2021</p>

            <p class="text-h1">Тип проекта</p>
            <p class="mb-3">Образовательные натавнические проекты в
                области культуры, искусства и ркеативных
                индустрий (включая цифровые технологии)</p>

            <p class="text-h1">Тематическое направление</p>
            <p class="mb-3">Культурный код. Проекты по продвижению через
                культуру и креативные индустрии традиционных
                духовно-нравственных ценностей.</p>

            <p class="text-h1">Рейтинг заявки</p>
            <p class="mb-3">73,75</p>

            <p class="text-h1">Номер заявки</p>
            <p class="mb-3">ПФКИ-21-1-019363</p>

        </div>
        
        <div class="counter">

            <p class="h1-counter">Размер гранта</p>
            <p class="h2-counter">450 600, 00  &#8381;</i></p>

            <div class="line"></div>
            <p class="h1-counter">Софинансирование</p>
            <p class="h2-counter">0, 00  &#8381;</i></p>

            <div class="line"></div>
            <p class="h1-counter">Общая сумма расходов на  реализацию проекта</p>
            <p class="h2-counter">450 600, 00  &#8381;</i></p>

            
        </div>

        <div class="block-info-left">

            <p class="text-h1">Дата подачи</p>
            <p class="mb-3">30.07.2021</p>

            <p class="text-h1">Сроки реализации</p>
            <p class="mb-3">01.10.2021 - 26.12.2022</p>

            <p class="text-h1">Заявитель</p>
            <p class="mb-3">МУНИЦИПАЛЬНОЕ АВТОНОМНОЕ УЧРЕЖДЕНИЕ ГОРОДСКОГО ОКРУГА КРАСНОУРАЛЬСК “ДВОРЕЦ КУЛЬТУРЫ МУТАЛУРГ”
            </p>

            <p class="text-h1">ИНН</p>
            <p class="mb-3">6620015110</p>

            <p class="text-h1">ОГРН/ОГРНИП</p>
            <p class="mb-3">01966200000267</p>

        </div>
    </div>
</section>
<section class="news-blocks container-fluid mt-4">
    <div class="block">
        <div class="row directions-block ">
            <div class="mt-2 d-flex justify-content-center">
                <p>
                    Мы не рекомендуем использовать для разметки материалов системы управления тегами — в этом
                    случае Метрика не
                    сможет корректно
                    обработать размеченные данные. Но такие системы можно использовать для других целей,
                    например, для установки
                    счетчика на сайт.
                    Все размеченные сущности Schema.org должны быть внутри тега body. Если на странице несколько
                    материалов,
                    каждый из них должен
                    быть размечен отдельно.
                </p>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                            aria-controls="flush-collapseOne">
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
    </div>
</section>

@guest
<x-registration-form></x-registration-form>
@endguest
@endsection

