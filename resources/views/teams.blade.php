@extends('layouts.main')

@section('content')

<section id="center-block">
<p class="h1-content">Наша команда</p>
    <div class="row row-cols-1 row-cols-md-2 w-card">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0 card-height">
                    <div class="col-md-5">
                        <img src="/images/1.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <div class="line"></div>
                            <p class="card-text">Это более широкая карта с вспомогательным текстом ниже в
                                качестве естественного перехода к дополнительному контенту. Этот контент немного
                                длиннее.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-3">
                <div class="row g-0 card-height">
                    <div class="col-md-5">
                        <img src="/images/1.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <div class="line"></div>
                            <p class="card-text">Это более широкая карта с вспомогательным текстом ниже в
                                качестве естественного перехода к дополнительному контенту. Этот контент немного
                                длиннее.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col right">
            <div class="card mb-3">
                <div class="row g-0 card-height">
                    <div class="col-md-5">
                        <img src="/images/1.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <div class="line"></div>
                            <p class="card-text">Это более широкая карта с вспомогательным текстом ниже в
                                качестве естественного перехода к дополнительному контенту. Этот контент немного
                                длиннее.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col right">
            <div class="card mb-3">
                <div class="row g-0 card-height">
                    <div class="col-md-5">
                        <img src="/images/1.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <div class="line"></div>
                            <p class="card-text">Это более широкая карта с вспомогательным текстом ниже в
                                качестве естественного перехода к дополнительному контенту. Этот контент немного
                                длиннее.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="news-blocks mt-4 container-fluid  d-flex justify-content-center ">
    <div class="directions-block">
        <div class="mt-2 d-flex justify-content-center">
            <p>
                Мы не рекомендуем использовать для разметки материалов системы управления тегами — в этом случае
                Метрика не
                сможет корректно
                обработать размеченные данные. Но такие системы можно использовать для других целей, например,
                для установки
                счетчика на сайт.
                Все размеченные сущности Schema.org должны быть внутри тега body. Если на странице несколько
                материалов,
                каждый из них должен
                быть размечен отдельно.
            </p>
        </div>
    </div>
</section>

@guest
<x-registration-form></x-registration-form>
@endguest
@endsection

