@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">

<style>
    .show-more  {
        text-decoration: none;
        cursor: pointer;
        color: inherit;
    }.text-about  {
        max-width: 70%;
    }
    .text-truncated {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .content-body {
        transition: height 200ms;
    }
    .content-info {
        transition: height 200ms;
    }
</style>
@endpush

@section('content')

<div class="container">
        <div class="main-container-directions">
            <h1 class="h1-content mt-0 mb-4">ИНФОРМАЦИЯ ПАРТНЁРАМ</h1>
            <div class="row gy-4 gx-5 d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card content-info">
                    <div class="card-body content-body">
                        <h5 class="card-title">Заголовок</h5>
                        <p class="card-text">Если ваши клиенты подключают наши продукты и сервисы, платим вам до 60 000 ₽ за каждого</p>
                        <div class="phrase-bg-img-1"></div>
                    </div>

                    </div>
                </div>
            </div>
<!--
            <h2 class="h1-content mt-3 mb-4">ИНФОРМАЦИЯ ПАРТНЁРАМ</h2> -->

            <div class="row gy-4 gx-5 d-flex justify-content-center mt-1">
                <div class="col-md-5">
                    <div class="card content-info">

                    <div class="card-body ">

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
                        <div class="phrase-bg-img-2"></div>
                    </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card content-info">
                    <div class="card-body">
                        <h5 class="card-title">Заголовок</h5>

                        <p class="text-about text-truncated card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet,
                            nulla et dictum interdum, nisi lorem egestas vitae scel erisque enim ligula venenatis dolor. Maecenas nisl
                            est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis
                            dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis.
                            Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</p>

                        <a class="show-more">Подробнее</a>
                        <div class="phrase-bg-img-2"></div>
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
                text.classList.toggle('text-truncated');
                button.innerHTML = button.innerHTML === 'Подробнее' ? 'Скрыть' : 'Подробнее';
            });
        });
    }
</script>
@endpush
