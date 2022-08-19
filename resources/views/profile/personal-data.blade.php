@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <form action="#" method="post" class="col-xs-12 col-md-12 col-lg-3">
            <img src="{{ asset('storage/posts/images/originals/tested_image.jpg') }}" alt="">

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
    </div>
</div>
@endsection

