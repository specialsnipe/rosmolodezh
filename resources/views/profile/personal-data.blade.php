@extends('profile.layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('flash_messages')
    @if(session()->has('message'))
        <div class="container p-0">

            <div class="alert alert-success alert-dismissible fade show w-100 m-0 mt-4" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

@endsection

@section('profile_content')

    <div class="row">
        <form action="{{ route('user.update_avatar') }}" method="post"
              class="col-xs-12 col-md-8 col-lg-3 d-flex flex-column upload-image" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <img src="{{ asset(auth()->user()->avatarMediumPath) }}" class="img-rounded rounded mb-3"
                 style="min-height: 352px; object-fit:cover;" alt="">
            <button type="button" class="img-btn">Нажмите для загрузки аватара</button>
            <input type="file" name="file" class="img-btn" hidden>
        </form>

        <form action="{{ route('user.update') }}" method="post" class="form-content mb-4 col-xs-12 col-md-12 col-lg-9">
            @csrf
            @method('PATCH')
            <div class="text-header mb-4">Ваши персональные данные</div>

        <div class="form-group row">
            <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                <div class="form-floating">
                    <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                        id="floatingInput" placeholder="Фамилия" value="{{ $user->last_name }}">
                    <label for="floatingInput">Фамилия</label>
                    @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                <div class="form-floating">
                    <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                        id="floatingPassword" placeholder="Имя" value="{{ $user->first_name }}">
                    <label for="floatingInput">Имя</label>
                    @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                <div class="form-floating">
                    <input name="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror"
                        id="floatingPassword" placeholder="Отчество" value="{{ $user->father_name }}">
                    <label for="floatingInput">Отчество</label>
                    @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                <div class="form-floating">
                    <input name="login" type="text" class="form-control @error('login') is-invalid @enderror"
                        id="floatingInput" placeholder="Username" value="{{ $user->login }}">
                    <label for="floatingInput">Логин</label>
                    @error('login') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                <div class="form-floating">
                    <input name="phone" type="text" class="form-control @error('email') is-invalid @enderror" id="phone"
                        placeholder="+7(000)000-00-00" value="{{ $user->phone }}">
                    <label for="floatingInput">Номер телефона</label>
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                <div class="form-floating">
                    <input name="age" type="number" maxlength="10" class="form-control @error('age') is-invalid @enderror"
                        placeholder="18" value="{{ $user->age }}">
                    <label for="floatingInput">Ваш возраст</label>
                    @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                <div class="input-group has-validation">
                    <span class="input-group-text" style="width: 20%;">@</span>
                    <div class="form-floating @error('tg_name') is-invalid @enderror" style="width: 80%;">
                        <input name="tg_name" type="text" class="form-control @error('tg_name') is-invalid @enderror" id="telegram" value="{{ $user->tg_name }}" placeholder="Username">
                        <label for="telegram">Username</label>
                    </div>
                    @error('tg_name') <span class="text-danger">{{ $message }}</span> @enderror


                    @if(isset($user->tg_id))
                        <span class="text-success">
                            Сконнектились!
                            <svg width="65" height="65" viewBox="0 0 65 65" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#8c64d8"
                                    d="M61.7353 32.3518L55.2286 24.9118L56.1353 15.0718L46.5086 12.8851L41.4686 4.35181L32.4019 8.24514L23.3353 4.35181L18.2953 12.8585L8.6686 15.0185L9.57527 24.8851L3.0686 32.3518L9.57527 39.7918L8.6686 49.6585L18.2953 51.8451L23.3353 60.3518L32.4019 56.4318L41.4686 60.3251L46.5086 51.8185L56.1353 49.6318L55.2286 39.7918L61.7353 32.3518ZM27.3086 44.9385L17.1753 34.7785L21.1219 30.8318L27.3086 37.0451L42.9086 21.3918L46.8553 25.3385L27.3086 44.9385Z"
                                    fill="black"/>
                            </svg>
                        </span>
                    @else
                        @if(!$errors->has('tg_name'))
                            <span class="text-danger" title="Вы не запустили бота"><i class="fa fa-times"></i> Телеграм не подтвержден</span>
                        @endif
                    @endif

                </div>
                </div>
                <div class=" mb-3 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-floating">
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            id="floatingPassword" placeholder="example@yandex.ru" value="{{ $user->email }}">
                        <label for="floatingInput">E-mail</label>
                        @if(isset($user->email_verified_at))
                            <span class="text-muted">(почта подтверждена: {{ $user->email_verified_at }})</span>
                        @else
                            <span class="text-danger"> (почта не подтверждена)</span>
                        @endif
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class=" mb-3 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-floating">
                        <input name="vk_url" type="text" class="form-control @error('vk_url') is-invalid @enderror"
                            id="floatingPassword" placeholder="вконтакте">
                        <label for="floatingInput">Ссылка на ВКонтакте</label>
                        @error('vk_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-floating">
                        <select name="gender_id" class="form-select @error('gender_id') is-invalid @enderror"
                                id="floatingSelect" aria-label="Floating label select example">
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}" @if($user->gender_id == $gender->id) selected @endif >{{
                            $gender->name
                            }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Ваш пол:</label>
                        @error('gender_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-floating">
                        <select name="occupation_id" class="form-select @error('occupation_id') is-invalid @enderror"
                                id="floatingSelect" aria-label="Floating label select example">
                            @foreach ($occupations as $occupation)
                                <option value="{{ $occupation->id }}" @if($user->occupation_id == $occupation->id) selected
                                    @endif
                                >{{
                            $occupation->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Занятость:</label>
                        @error('occupation_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                @if(auth()->user()->role->name === 'tutor' || auth()->user()->role->name === 'teacher')
                    <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating">
                            <input name="curator_job" type="text"
                                class="form-control @error('curator_job') is-invalid @enderror"
                                id="floatingInput" placeholder="Место работы куратора" value="{{ $user->curator_job }}">
                            <label for="floatingInput">
                            @if(auth()->user()->role->name === 'tutor')
                                Место работы куратора
                            @endif
                            @if(auth()->user()->role->name === 'teacher')
                                Место работы учителя
                            @endif
                            </label>
                            @error('curator_job') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating">
                            <input name="curator_about" type="text"
                                class="form-control @error('curator_about') is-invalid @enderror" id="floatingInput"
                                placeholder="О кураторе" value="{{ $user->curator_about }}">
                            <label for="floatingInput">
                            @if(auth()->user()->role->name === 'tutor')
                                О кураторе
                            @endif
                            @if(auth()->user()->role->name === 'teacher')
                                Об учителе
                            @endif
                            </label>
                            @error('curator_about') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @endif
                <div class="form-floating col-sm-12 col-md-6 col-lg-6 float-end">
                    <button type="submit" class="btn-apply">Применить изменения</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-4">
        <form action="{{ route('user.change_password') }}" method="post"
              class="form-content col-xs-12 col-md-12 col-lg-12">
            @csrf
            @method('put')
            <div class="text-header mb-2">Смена пароля</div>
            <div class="form-group row">

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-3">
                    <input type="old_password" class="form-control" id="floatingInput" placeholder="Password"
                           name="old_password">
                    <label for="floatingPassword">Ваш старый пароль</label>
                    @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="Password"
                           name="password">
                    <label for="floatingPassword">Новый пароль</label>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                           name="password_confirmation">
                    <label for="floatingPassword">Повторите новый пароль</label>
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-3">
                    <button type="submit" class="btn-apply-pass">Сохранить новый пароль</button>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('script')
    <script defer>
        $('button.img-btn').on('click', function (event) {
            $('input.img-btn').click()
        })
        $('input.img-btn').on('input', function (event) {
            $('.upload-image').trigger("submit");
        })


        window.addEventListener("DOMContentLoaded", function () {
            [].forEach.call(document.querySelectorAll('#phone'), function (input) {
                var keyCode;

                function mask(event) {
                    event.keyCode && (keyCode = event.keyCode);
                    var pos = this.selectionStart;
                    if (pos < 3) event.preventDefault();
                    var matrix = "+7 (___) ___ ____",
                        i = 0,
                        def = matrix.replace(/\D/g, ""),
                        val = this.value.replace(/\D/g, ""),
                        new_value = matrix.replace(/[_\d]/g, function (a) {
                            return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                        });
                    i = new_value.indexOf("_");
                    if (i != -1) {
                        i < 5 && (i = 3);
                        new_value = new_value.slice(0, i)
                    }
                    var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                        function (a) {
                            return "\\d{1," + a.length + "}"
                        }).replace(/[+()]/g, "\\$&");
                    reg = new RegExp("^" + reg + "$");
                    if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                    if (event.type == "blur" && this.value.length < 5) this.value = ""
                }

                input.addEventListener("input", mask, false);
                input.addEventListener("focus", mask, false);
                input.addEventListener("blur", mask, false);
                input.addEventListener("keydown", mask, false)

            });

        });
    </script>
@endpush
