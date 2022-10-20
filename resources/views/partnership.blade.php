@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@section('content')

<div class="container">
        <div class="main-container-directions">
            <h1 class="h1-content mt-0 mb-4">ИНФОРМАЦИЯ ПАРТНЁРАМ</h1>
            <div class="row gy-4 gx-5 d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                    <div class="card-body content-info">
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
                    <div class="card">
                        
                    <div class="card-body content-info">
                        
                        <h5 class="card-title">Заголовок</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas vitae scel<span id="dots">...</span><span id="more">erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span></p>

                        <button onclick="myFunction()" id="myBtn">Подробнее</button></p>
                        <div class="phrase-bg-img-2"></div>
                    </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                    <div class="card-body content-info">
                        <h5 class="card-title">Заголовок</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas vitae scel<span id="dots">...</span><span id="more">erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span></p>

                        <button onclick="myFunction()" id="myBtn">Подробнее</button></p>
                        <div class="phrase-bg-img-2"></div>
                    </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                    <div class="card-body content-info">
                        <h5 class="card-title">Заголовок</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas vitae scel<span id="dots">...</span><span id="more">erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span></p>

                        <button onclick="myFunction()" id="myBtn">Подробнее</button></p>
                        <div class="phrase-bg-img-2"></div>
                    </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                    <div class="card-body content-info">
                        <h5 class="card-title">Заголовок</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas vitae scel<span id="dots">...</span><span id="more">erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span></p>

                        <button onclick="myFunction()" id="myBtn">Подробнее</button></p>
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
    function myFunction() {
    let dots = document.getElementById("dots");
    let moreText = document.getElementById("more");
    let btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Подробнее";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Скрыть";
        moreText.style.display = "inline";
    }

}
</script>
@endpush
