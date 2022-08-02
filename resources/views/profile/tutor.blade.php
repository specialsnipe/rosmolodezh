@extends('layouts.main')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
<div class="main-containers rounded-top">
    <div class="avatar-content row">
        <div class="avatar col-xs-12 col-md-12 col-lg-3">
            <img src="images/1.jpg" alt="">

            <button class="mb-4 img-btn">Нажмите для загрузки аватара</button>
        </div>

        <div class="form-content mb-4 col-xs-12 col-md-12 col-lg-9">
            <div class="text-header mb-4">Данные куратора</div>

            <div class="form-group mb-3 row">

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Фамилия</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingInput">Имя</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingInput">Отчество</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Логин</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input type="email" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingInput">E-mail</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <input type="number" maxlength="10" class="form-control" placeholder="Password">
                    <label for="floatingInput">Ваш возраст</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6" style="display: flex; ">
                    <span style="width: 40px; display:flex; justify-content: center; align-items: center; background-color:#4886FF;
                    border-radius: 5px 0 0 5px ; color: white;">@</span>
                    <input style="border-radius: 0 5px 5px 0;" type="text" id="telegram" class="form-control"
                        placeholder="Telegram Username" aria-label="Username" aria-describedby="basic-addon1">
                    <label for="floatingPassword" style="margin-left:40px;">Telegram UserName</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
                    <input type="email" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingInput">Ссылка на Вкотакте</label>
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->id }}" @if(auth()->user()->gender_id == $gender->id) @endif >{{ $gender->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Ваш пол:</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        @foreach ($occupations as $occupation)
                            <option value="{{ $occupation->id }}" @if(auth()->user()->occupation_id == $occupation->id) @endif >{{ $occupation->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Занятость:</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        @if(!isset(auth()->user()->tracks[0]->id))
                            <option value="0" selected disabled>Выбери направление</option>
                        @endif
                        @foreach ($tracks as $track)
                            <option value="{{ $track->id }}" @if(isset(auth()->user()->tracks[0]->id) && auth()->user()->tracks[0]->id == $track->id) selected
                                @endif>{{ $track->title }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Направление:</label>
                </div>
                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
                    <button class="btn-apply">Применить изменения</button>
                </div>
            </div>
        </div>
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
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                            aria-controls="flush-collapseOne">
                            <table class="table">
                                <tr>
                                    <td scope="col">Посомтреть всех учеников</th>
                                </tr>
                            </table>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <table class="table table-2" id="nonborder">
                            <thead>
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Блок №</th>
                                    <th scope="col">Результат</th>
                                    <th scope="col">Кол-во баллов</th>
                                    <th scope="col">Время</th>
                                    <th scope="col">Комментарий</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>

                                </tr>
                                <tr>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="add-block mt-4">
                <div class="text">
                    <div class="text-h1">В блоке пока нет заданий</div>
                    <div class="text-h2">Нажмите добавить чтобы перейти к добалвению заданий в блок</div>
                </div>
                <div class="btn-add">
                    <button class="btn">Добавить задание</button>
                </div>
            </div>

            <div class="edit-block mt-4 mb-4">
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
                                <p class="number-two rating-five">5</p>
                            </div>
                            <div class="one">
                                <p>Преподаватель: Семенов. А.B.</p>
                            </div>
                        </div>
                        <button class="btn">Редактировать</button>
                    </div>
                </div>
                <section id="accordion-w">
                    <div class=" accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">

                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
                                                <button class="del-btn">Удалить</button>
                                                <button class="edit-btn">Редактировать</button>
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
                                                <button class="del-btn">Удалить</button>
                                                <button class="edit-btn">Редактировать</button>
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
                                                <button class="del-btn">Удалить</button>
                                                <button class="edit-btn">Редактировать</button>
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
                                                <button class="del-btn">Удалить</button>
                                                <button class="edit-btn">Редактировать</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </section>
            </div>
        </div>
    </div>
@endsection
