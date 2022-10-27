
@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@extends('layouts.main')

@section('content')

<div class="container mb-5 mt-5">
        <h1 class="h1-content mt-0 mb-4">О нашем проекте</h1>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card content-info">
                    <div class="card-body content-body">
                        <h5 class="card-title">Коротко о проетке</h5>
                        <p class="card-text">IT компания по разработке и поддержки веб-проектов.</p>
                    </div>
                    <div class="bg-icon w-100">
                        <div class="phrase-bg-img-about"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card content-info h-100">
                    <div class="card-body content-body">
                        <h5 class="card-title">Nethamer.lab</h5>
                        <p class="card-text">IT компания по разработке и поддержки веб-проектов.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="content-img img-bg-about h-100"></div>
            </div>
            <section class="row fix-adaptiv">
            <div class="col-md-6">
                <div class="content-img img-bg-about-1"></div>
            </div>

            <div class="col-md-6">
                <div class="card content-info-1">
                    <div class="card-body content-body">
                        <h5 class="card-title">Главные приимущества комании Nethamer</h5>
                        <p class="card-text">Опыт и постоянное соверсшенствовние навыков программирования сотрудников</p>
                        <p class="card-text">А также индивидуальный подход к каждому клиенту.</p>
                        <p class="card-text">IT компания по разработке и поддержки веб-проектов.</p>
                        <p class="card-text">А также индивидуальный подход к каждому клиенту.</p>
                        <p class="card-text">IT компания по разработке и поддержки веб-проектов.</p>
                    </div>
                </div>
            </div>
            </section>
            <div class="col-md-3 mt-3 d-flex flex-column align-items-center">
                <div class="icon-bg"><i class="fas fa-user-graduate"></i></div>
                <text class="text-center mt-2">Столько то преподавателей в нашем проекте</text>
            </div>
            <div class="col-md-3 d-flex flex-column align-items-center mt-3">
                <div class="icon-bg"><i class="fas fa-user-graduate"></i></div>
                <text class="text-center mt-2">Столько то преподавателей в нашем проекте</text>
            </div>
            <div class="col-md-3 d-flex flex-column align-items-center mt-3">
                <div class="icon-bg"><i class="fas fa-user-graduate"></i></div>
                <text class="text-center mt-2">Столько то преподавателей в нашем проекте</text>
            </div>
            <div class="col-md-3 d-flex flex-column align-items-center mt-3">
                <div class="icon-bg"><i class="fas fa-user-graduate"></i></div>
                <text class="text-center mt-2">Столько то преподавателей в нашем проекте</text>
            </div>

            <div class="col-md-6">
                <div class="content-img img-bg-about-2"></div>
            </div>

            <div class="col-md-6">
                <div class="card content-info-2">
                    <div class="card-body content-body">
                        <h5 class="card-title">Дата подачи</h5>
                        <p class="card-text">30.07.2021</p>
                        <h5 class="card-title">Сроки реализации</h5>
                        <p class="card-text">01.10.2021 - 26.12.2022</p>
                        <h5 class="card-title">Заявитель</h5>
                        <p class="card-text">
                            МУНИЦИПАЛЬНОЕ АВТОНОМНОЕ
                            УЧРЕЖДЕНИЕ ГОРОДСКОГО ОКРУГА
                            КРАСНОУРАЛЬСК “ДВОРЕЦ КУЛЬТУРЫ
                            МУТАЛУРГ”
                        </p>
                        <h5 class="card-title">ИНН</h5>
                        <p class="card-text">6620015110</p>
                        <h5 class="card-title">ОГРН/ОГРНИП</h5>
                        <p class="card-text">01966200000267</p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card content-info-3">
                    <div class="card-body content-body row">
                        <div class="col-md-6">
                            <h5 class="card-title">Конкурс</h5>
                            <p class="card-text">Первый конкурс 2021</p>
                            <h5 class="card-title">Тип проекта</h5>
                            <p class="card-text">
                                Образовательные натавнические проекты в
                                области культуры, искусства и ркеативных
                                индустрий (включая цифровые технологии)
                            </p>
                            <h5 class="card-title">Рейтинг заявки</h5>
                            <p class="card-text">73,75</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">Тематическое направление</h5>
                            <p class="card-text">
                                Культурный код. Проекты по продвижению через
                                культуру и креативные индустрии традиционных
                                духовно-нравственных ценностей.”
                            </p>
                            <h5 class="card-title">Номер заявки</h5>
                            <p class="card-text">ПФКИ-21-1-019363</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="row d-flex justify-content-center mt-1">

            <div class="col-md-6">
                <div class="card content-info">

                <div class="card-body content-body">

                    <h5 class="card-title"></h5>
                    <p class="text-about text-truncated card-text">

                    </p>

                    <a class="show-more"><span class="button-text">Подробнее</span> <i class="fa fa-angle-up reverse"></i></a>
                </div>

                <div class="bg-icon w-100">
                    <div class="phrase-bg-img-2"></div>
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card content-info">

                <div class="card-body content-body">

                    <h5 class="card-title">Пока что нам нечего вам покаазть</h5>
                    <p class="text-about text-truncated card-text">
                    </p>

                    <a class="show-more"><span class="button-text">Подробнее</span> <i class="fa fa-angle-up reverse"></i></a>

                </div>

                <div class="bg-icon w-100">
                    <div class="phrase-bg-img-2"></div>
                </div>
                </div>
            </div>

        </div> -->
</div>

@guest
<section class="container">
<x-registration-form></x-registration-form>
</section>
@endguest
@endsection

