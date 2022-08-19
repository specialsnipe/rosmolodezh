@php
$user = auth()->user();
@endphp

@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

<div class="main-containers rounded-top ">


        <div class="grade-block">
            <div class="form-content mb-4 col-xs-12 col-md-12 col-lg-12">
                <div class="text-header mb-4">Смена пароля</div>
                <div class="form-group row">
                    <div class="form-floating mb-3 col-sm-12 col-md-4 col-lg-4">
                        <input type="password" class="form-control" id="floatingInput" placeholder="Password">
                        <label for="floatingPassword">Пароль</label>
                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-4 col-lg-4">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Повторите пароль</label>
                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-4 col-lg-4">
                        <button class="btn-apply">Сохранить новый пароль</button>
                    </div>
                </div>
            </div>
            <div class="grade-block">
                @foreach ($blocks as $block)
                <div class="edit-block  mt-4 mb-4">
                    <div class="edit-row">
                        <div class="text">
                            <div class="text-h1">{{ $block->title }}</div>
                            <div class="text-h2">{{ $block->body }}</div>

                            <div class="information">
                                <div class="block-start">
                                    Начался: <span> {{ $block->date_start }}</span>
                                </div>
                                <div class="block-end">
                                    Закончился: <span> {{ $block->date_end }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="btn-edit">
                            <div class="info-block">
                                <div class="one">
                                    <p>Часы(ов):</p>
                                    <p class="number-one"> {{ $block->duration }}</p>
                                </div>
                                <div class="one">
                                    <p>Твой средний балл:</p>
                                    <p class="number-two rating-two"> {{ $block->average_score }}</p>
                                </div>
                                <div class="one">
                                    <p>Преподаватель: {{ $block->teacher->short_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="accordion-w">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="collapseOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="d-flex-card">
                                            @forelse($block->exercises as $exercise)
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-content">
                                                        <p class="text-h1">{{ $exercise->title }}</p>
                                                        <p>
                                                            {{ $exercise->excerpt }}
                                                        </p>
                                                    </div>
                                                    <div class="column">
                                                    <div class="one">
                                                            <p>Сложность:</p>
                                                            <p class="coplexity rating-two"> Сложно </p>
                                                        </div>
                                                        <div class="one">
                                                            <p>Минут:</p>
                                                            <p class="number-one">{{ $exercise->time }}</p>
                                                        </div>
                                                        <div class="one">
                                                            <p>Оценка:</p>
                                                            <p class="number-two rating-two"> 2</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="down-content">

                                                    <a href="{{ route('blocks.exercises.show', [$block->id, $exercise->id] ) }}" class="edit-btn">Подробнее...</a>
                                                </div>
                                            </div>
                                            @empty
                                            Нет упражнений в этом блоке
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
                @endforeach


                {{-- <div class="locked-task edit-block mt-4 mb-4">
                    <div class="edit-row">
                        <div class="text">
                            <div class="text-h1">Название блока</div>
                            <div class="text-h2">Здесь вы научитесь основам программирования с вашим руководителем
                                данного
                                направления: Семеновым Анатолием</div>

                            <div class="information">
                                <div class="block-start">
                                    Начался:
                                </div>
                                <div class="block-end">
                                    Закончился:
                                </div>
                            </div>
                        </div>

                        <div class="btn-edit">
                            <div class="info-block">
                                <div class="one">
                                    <p>Часы(ов):</p>
                                    <p class="number-one">12</p>
                                </div>
                                <div class="one">
                                    <p>Средний балл:</p>
                                    <p class="number-two rating-two"> 2</p>
                                </div>
                                <div class="one">
                                    <p>Преподаватель: Семенов. А.B.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="accordion-w">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="d-flex-card">
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <img class="img-edit" src="images/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-two"> 2</p>
                                                    </div>
                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <img class="img-edit" src="images/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-three">3</p>
                                                    </div>
                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <img class="img-edit" src="images/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-five">5</p>
                                                    </div>
                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <img class="img-edit" src="images/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-four">4</p>
                                                    </div>
                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="edit-block block-for-five mt-4 mb-4">
                    <div class="edit-row">
                        <div class="text">
                            <div class="text-h1">Название блока</div>
                            <div class="text-h2">Здесь вы научитесь основам программирования с вашим руководителем
                                данного
                                направления: Семеновым Анатолием</div>

                            <div class="information">
                                <div class="block-start">
                                    Начался:
                                </div>
                                <div class="block-end">
                                    Закончился:
                                </div>
                            </div>
                        </div>

                        <div class="btn-edit">
                            <div class="info-block">
                                <div class="one">
                                    <p>Часы(ов):</p>
                                    <p class="number-one">12</p>
                                </div>
                                <div class="one">
                                    <p>Средний балл:</p>
                                    <p class="number-two rating-five"> 5</p>
                                </div>
                                <div class="one">
                                    <p>Преподаватель: Семенов. А.B.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="accordion-w">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="d-flex-card">
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-two"> 2</p>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="down-content">

                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <img class="img-edit" src="images/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-three">3</p>
                                                    </div>
                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <img class="img-edit" src="images/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-five">5</p>
                                                    </div>
                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                            <div class="card-edit">
                                                <div class="top-content">
                                                    <div class="text-cintent">
                                                        <p class="text-h1">Заголовок</p>
                                                        <p>
                                                            В этом задании вам нужно выполнить
                                                            верстку по макету В этом задании
                                                            вам нужно выполнить верстку по макету
                                                            В этом задании вам нужно выполнить верстку
                                                            по макету
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <img class="img-edit" src="images/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">12</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-four">4</p>
                                                    </div>
                                                    <button class="edit-btn">Подробнее...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </section>
                </div> --}}
            </div>
        </div>
    </div>
    @endsection
