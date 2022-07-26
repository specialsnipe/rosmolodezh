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
                                        @endif>{{$role->rus_name}}</option>
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
                                        <input type="text" class="form-control" name="tg_name"
                                            placeholder="username" id="tg_name" aria-describedby="tg_name_addon"
                                            value="{{ $user->tg_name }}">
                                    </div>
                                    @error('tg_name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                    <label for="tg_username">Телеграм id</label>
                                    <input type="text" class="form-control" name="tg_username"
                                        placeholder="Когда пользователь подтвердит свою учетную запись" id="tg_id" aria-describedby="tg_id"
                                        value="{{ $user->tg_id }}" readonly>
                                </div>

                                <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                    <label for="vk_url">Ссылка на ВКонтакте</label>
                                    <input type="text" class="form-control" name="vk_url"
                                        placeholder="vk url" id="vk_url" aria-describedby="vk_url_addon"
                                        value="{{ $user->vk_url }}">
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
                                    <img src="{{ asset($user->avatar_medium_path) }}" class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar"
                                    height="100" alt="старый аватар пользователя">
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
    </script>
@endpush
