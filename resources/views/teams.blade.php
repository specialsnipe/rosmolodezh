@extends('layouts.main')

@section('content')
<p class="h1-content">Наша команда</p>
<section class="container">
    <div class="row row-cols-1 row-cols-md-2 w-card">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0 card-height">
                    <div class="col-md-5">
                        <img src="/images/1.jpg" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">Петров Василий Петрович</h5>
                            <div class="line"></div>
                            <p class="card-text">Он профессионал своего профессионализма, и профессионально профессионалит и тут, своими проф. навыками шокирует других
                                недопрофессионалов которые не достаточно профессиональны для того чтобы состязаться с Василием Петровичем.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<div class="screen news-blocks mt-4">
    <section class="container  d-flex justify-content-center ">
        <div class="directions-block">
            <div class="mt-2 d-flex justify-content-center">
                <p>
                    Возможно этот блок и не нужен, но его сверстали
                </p>
            </div>
        </div>
    </section>
</div>
@guest
<div class="container">
    <x-registration-form></x-registration-form>
</div>
@endguest
@endsection
