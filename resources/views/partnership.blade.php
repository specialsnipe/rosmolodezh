@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">

<style>

    .show-more  {
        text-decoration: none;
        cursor: pointer;
        color: inherit;
    }
    .text-about  {
        max-width: 70%;
    }
    .text-truncated {
        overflow: hidden;
        height: 70px;
    }
    .text-about {
        transition: height 0.2s;
        -moz-transition: height 0.2s; /* Firefox 4 */
        -webkit-transition: height 0.2s; /* Safari and Chrome */
        -o-transition: height 0.2s; /* Opera */
    }
    .text-showed {
        height: auto !important;
        overflow: hidden;
    }
    .content-body {
        max-height: auto;
        z-index: 2;
    }
    .bg-icon {
        position: absolute;
        top:0;
        width: 100%;
        height: 200px;
        z-index: 1;
    }
    .phrase-bg-img-2 {
        transition: 200ms;
    }
</style>
@endpush

@section('content')

<div class="container">
        <div class="main-container-directions">
            <h1 class="h1-content mt-0 mb-4">ИНФОРМАЦИЯ ПАРТНЁРАМ</h1>
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card content-info">
                        <div class="card-body content-body">
                            <h5 class="card-title">Заголовок</h5>
                            <p class="card-text">Если ваши клиенты подключают наши продукты и сервисы, платим вам до 60 000 ₽ за каждого</p>
                        </div>
                        <div class="bg-icon w-100">
                            <div class="phrase-bg-img-1"></div>
                        </div>
                    </div>
                </div>
            </div>
<!--
            <h2 class="h1-content mt-3 mb-4">ИНФОРМАЦИЯ ПАРТНЁРАМ</h2> -->

            <div class="row d-flex justify-content-center mt-1">
                <div class="col-md-6">
                    <div class="card content-info">

                    <div class="card-body content-body">

                        <h5 class="card-title">Заголовок</h5>
                        <p class="text-about text-truncated card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas vitae scel
                                erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget,
                                auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed
                                ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis.
                                Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum.
                                Sed dapibus pulvinar nibh tempor porta.
                        </p>

                        <a class="show-more">Подробнее</a>

                    </div>

                    <div class="bg-icon w-100">
                        <div class="phrase-bg-img-2"></div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card content-info">
                        <div class="card-body content-body">
                            <h5 class="card-title">Заголовок</h5>

                            <p class="text-about text-truncated card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet,
                                nulla et dictum interdum, nisi lorem egestas vitae scel erisque enim ligula venenatis dolor. Maecenas nisl
                                est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis
                                dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis.
                                Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</p>

                            <a class="show-more">Подробнее</a>
                        </div>

                    <div class="bg-icon w-100">
                        <div class="phrase-bg-img-2"></div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

<script>
    window.onload = function() {

        let moreButtons = document.querySelectorAll('.show-more');
        moreButtons.forEach((button) => {
            button.addEventListener('click',(event)=>{
                let text = button.parentNode.querySelector('.text-about');
                let content = button.parentNode;
                text.style.height = text.style.height.split('px')[0] == text.scrollHeight
                    ? "70px"
                    : text.scrollHeight + "px";
                button.innerHTML = button.innerHTML === 'Подробнее' ? 'Скрыть' : 'Подробнее';
            });
        });
    }
</script>
@endpush
