@php
$user = auth()->user();
@endphp

@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

<div class="main-containers rounded-top ">
    <div class="avatar-content row">
        <form action="#" method="post" class="avatar col-xs-12 col-md-12 col-lg-3">
            <img src="images/1.jpg" alt="">

            <button class="mb-4 img-btn">Нажмите для загрузки аватара</button>
        </form>

        <form action="{{ route('user.update') }}" method="post" class="form-content mb-4 col-xs-12 col-md-12 col-lg-9">
            <div class="text-header mb-4">Личные данные "{{ $user->first_and_last_names }}"</div>

            <div class="form-group row">
                @csrf
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input name="second_name" type="text" class="form-control" id="floatingInput" placeholder="Фамилия"
                        value="{{ $user->last_name }}">
                    <label for="floatingInput">Фамилия</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input name="first_name" type="text" class="form-control" id="floatingPassword" placeholder="Имя"
                        value="{{ $user->first_name }}">
                    <label for="floatingInput">Имя</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input name="father_name" type="text" class="form-control" id="floatingPassword"
                        placeholder="Отчество" value="{{ $user->father_name }}">
                    <label for="floatingInput">Отчество</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input name="login" type="text" class="form-control" id="floatingInput" placeholder="Username"
                        value="{{ $user->login }}">
                    <label for="floatingInput">Логин</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input name="email" type="email" class="form-control" id="floatingPassword"
                        placeholder="example@yandex.ru" value="{{ $user->login }}">
                    <label for="floatingInput">E-mail</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input name="age" type="number" maxlength="10" class="form-control" placeholder="18"
                        value="{{ $user->age }}">
                    <label for="floatingInput">Ваш возраст</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6" style="display: flex; ">
                    <span style="width: 40px; display:flex; justify-content: center; align-items: center; background-color:#4886FF;
                    border-radius: 5px 0 0 5px ; color: white;">@</span>
                    <input name="tg_name" style="border-radius: 0 5px 5px 0;" type="text" id="telegram"
                        class="form-control" placeholder="Telegram Username" aria-label="Username"
                        aria-describedby="basic-addon1" value="{{ $user->tg_name }}">
                    <label for="floatingPassword" style="margin-left:40px;">Telegram Username</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
                    <input name="vk_url" type="text" class="form-control" id="floatingPassword" placeholder="вконтакте">
                    <label for="floatingInput">Ссылка на ВКонтакте</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <select name="gender_id" class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}" @if($user->gender_id == $gender->id) @endif >{{ $gender->name
                            }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Ваш пол:</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <select name="occupation_id" class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        @foreach ($occupations as $occupation)
                        <option value="{{ $occupation->id }}" @if($user->occupation_id == $occupation->id) @endif >{{
                            $occupation->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Занятость:</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <select class="form-select disabled" id="floatingSelect" aria-label="Floating label select example"
                        disabled>
                        @foreach ($tracks as $track)
                        <option value="{{ $track->id }}" @if($user->tracks[0]->id == $track->id) selsected @endif >{{
                            $track->title }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Направление:</label>
                </div>
                <div class="form-floating col-sm-12 col-md-6 col-lg-6 float-end">
                    <button type="submit" class="btn-apply ">Применить изменения</button>
                </div>
            </div>
        </form>

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
                                                    <div class="text-cintent">
                                                        <p class="text-h1">{{ $exercise->title }}</p>
                                                        <p>
                                                            {{ $exercise->excerpt }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="down-content">
                                                    <div class="one">
                                                        <p>Минут:</p>
                                                        <p class="number-one">{{ $exercise->time }}</p>
                                                    </div>
                                                    <div class="one">
                                                        <p>Оценка:</p>
                                                        <p class="number-two rating-two"> 2</p>
                                                    </div>
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
                    </section>
                </div>
            </div>
        </div>
    </div> --}}
    @endsection
