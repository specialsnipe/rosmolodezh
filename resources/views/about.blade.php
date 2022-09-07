
@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@extends('layouts.main')

@section('content')

<p class="h1-content">О нашем проекте </p>
<section class="counter-block container">
    <div class="counter-content">
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
<section class="screen news-blocks">
    <div class="container p-0">
        <h2 class="text-light d-flex justify-content-center w-100 mt-2 mb-4">Все направления</h2>
        <div class="row">
            @foreach ($tracks as $track)
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card card-track d-flex flex-column justify-content-between mb-4">

                    <a target="_blank" href="{{ route('tracks.show', $track->id) }}">
                        <img src="{{ asset($track->imageMedium ) }}" class="card-img-top rounded" alt="...">
                    </a>
                    <a target="_blank" href="{{ route('tracks.show', $track->id) }}" class="card-footer">
                        <div class="">{{ $track->title }}</div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>


        <div class="mt-2 d-flex justify-content-center">
            <p>
                Текcт для того чтобы пояснить что вообще зачем тут это и всё
            </p>
        </div>
    </div>
</section>

@guest
<section class="container">
<x-registration-form></x-registration-form>
</section>
@endguest
@endsection

