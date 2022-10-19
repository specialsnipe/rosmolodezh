@extends('admin.layouts.main')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Изменить пользователя
                        <span class="badge badge-info">{{ $user->all_names }} id: {{ $user->id }}</span>
                    </h1>
                    @if(isset($isCurator))
                        <h2 class="text-success">
                                    Является куратором направления {{ $isCurator->title }}
                                </h2>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                        <li class="breadcrumb-item active">Изменить пользователя</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    Изменить данные пользователя
                </div>
                <div class="card-body row">
                    <form action="{{route('admin.users.update', $user->id)}}" method="post"
                        enctype="multipart/form-data" class="col-12">
                        @csrf
                        @method('put')
                        <div class="form-group row">

                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="email">Почта</label>
                                <input type="text" class="form-control " name="email" placeholder="Почта" id="email"
                                    value="{{ $user->email }}">
                                @error('email')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="first_name">Имя </label>
                                <input type="text" class="form-control " name="first_name" placeholder="Имя"
                                    id="first_name" value="{{ $user->first_name}}">
                                @error('first_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="last_name">Фамилия</label>
                                <input type="text" class="form-control " name="last_name" placeholder="Фамилия"
                                    id="last_name" value="{{ $user->last_name}}">
                                @error('last_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="father_name">Отчество <span class="text-muted">(если есть)</span></label>
                                <input type="text" class="form-control " name="father_name" placeholder="Отчество"
                                    id="father_name" value="{{ $user->father_name }}">
                                @error('father_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="age">Возраст</label>
                                <input type="number" class="form-control " name="age" placeholder="Возраст" id="age"
                                    value="{{ $user->age }}">
                                @error('age')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="gender_id">Пол</label>
                                <select class="form-control " name="gender_id" id="gender_id">
                                    <option value="0" disabled selected>пол</option>
                                    @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}" @if( $user->gender_id == $gender->id) selected
                                        @endif>{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="role_id">Роль </label>
                                <select class="form-control " name="role_id" id="role_id">
                                    <option value="0" disabled selected>роль</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" @if( $user->role_id == $role->id) selected
                                        @endif>{{$role->readable_name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="occupation_id">Занятость</label>
                                <select class="form-control " name="occupation_id" id="occupation_id">
                                    <option value="0" disabled selected>занятость</option>
                                    @foreach($occupations as $occupation)
                                    <option value="{{$occupation->id}}" @if( $user->occupation_id == $occupation->id)
                                        selected @endif>{{$occupation->name}}</option>
                                    @endforeach
                                </select>
                                @error('occupation_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="track_id">Направление</label>
                                <select class="form-control " name="track_id" id="track_id">
                                    <option value="0" disabled selected>Выберите направление</option>
                                    @foreach($tracks as $track)
                                    <option value="{{$track->id}}" @if(isset($user->tracks[0]->id) && $user->tracks[0]->id == $track->id) selected
                                        @endif>{{$track->title}}</option>
                                    @endforeach
                                </select>
                                @error('occupation_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            @if($isCurator)
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="title">Место работы куратора</label>
                                <input type="text" class="form-control " id="title" name="curator_job" placeholder="Место работы куратора" value="{{$user->curator_job}}">
                                @error('curator_job')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            @endif
                            @if($isCurator)
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="body">О кураторе</label>
                                <textarea type="text" class="form-control" id="body" name="curator_about" placeholder="О кураторе"> {{$user->curator_about}} </textarea>
                                @error('curator_about')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            @endif
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <div>
                                    <label for="phone">Телефон</label>
                                </div>

                                <input
                                    class="form-control"
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    placeholder="+7(000)000-00-00" value="{{$user->phone}}"/>
                            </div>
                        </div>
                        <hr>
                        {{-- telegram change --}}
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="tg_name">Имя в телеграм</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold text-black-50"
                                            id="tg_name_addon">@</span>
                                    </div>
                                    <input type="text" class="form-control" name="tg_name" placeholder="username"
                                        id="tg_name" aria-describedby="tg_name_addon" value="{{ $user->tg_name }}">
                                </div>
                                @error('tg_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="tg_id">Телеграм id</label>
                                <input type="text" class="form-control" name="tg_id"
                                    placeholder="После подтверждения TG" id="tg_id"
                                    aria-describedby="tg_id" value="{{ $user->tg_id }}" readonly>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                <label for="vk_url">Ссылка на ВКонтакте</label>
                                <input type="text" class="form-control" name="vk_url" placeholder="vk url" id="vk_url"
                                    aria-describedby="vk_url_addon" value="{{ $user->vk_url }}">
                                @error('vk_url')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        {{-- avatar change --}}
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 text-right">
                                <div class="row">
                                    <img src="{{ asset($user->avatar_medium_path) }}"
                                        class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar" height="100"
                                        alt="старый аватар пользователя">
                                    <span class="col-12  text-muted text-align-right">* старый аватар</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 text-right">
                                <div class="row">
                                    <img src="" class="col-12 rounded img-fluid img-thumbnail mb-2 preview_avatar"
                                        height="100" alt="новый аватар пользователя">
                                    <span class="col-12 text-muted text-align-right">* новый аватар</span>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-8">

                                <label for="avatar">Аватар пользователя</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="avatar" class="custom-file-input" name="file" id="avatar"
                                            value="Выбирите">
                                        <label class="custom-file-label" for="avatar">Выберите
                                            картинку</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary col-sm-12" value="Сохранить">
                    </form>
                </div>
            </div>
            <div class="card col-sm-12 col-lg-4">
                <div class="card-header">
                    Изменить пароль
                </div>
                <div class="card-body row">
                    <div class="col-12">
                        <form action="{{route('admin.users.change_password', $user->id)}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" class="form-control " name="password" placeholder="Пароль"
                                    id="password" value="">
                                @error('password')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Повтор пароля</label>
                                <input type="password" class="form-control " name="password_confirmation"
                                    placeholder="Повтор пароля" id="password_confirmation" value="">
                                @error('password_confirmation')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary col-sm-12" value="Обновить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('script')
<script>
    let input = document.querySelector('.custom-file-input');
        let preview = document.querySelector(".preview_avatar");
        input.addEventListener('change', function(event) {
            if(event.target.files.length > 0){
                let src = URL.createObjectURL(event.target.files[0]);
                preview.src = src;
                preview.style.display = "block";
            }
        })

        preview.addEventListener('click', function () {
            input.click();
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
