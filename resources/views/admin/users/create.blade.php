@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Создание пользователя</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Пользователи</a></li>
                            <li class="breadcrumb-item active">Создание пользователя</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data" class="col-12">
                                @csrf
                                <div class="form-group row">
                                    {{-- Login --}}
                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="login">Логин <span class="text-muted">(используется для входа на сайт)</span></label>
                                        <input type="text" class="form-control " name="login" placeholder="Логин" id="login"
                                            value="{{old('login')}}">
                                        @error('login')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="email">Почта</label>
                                        <input type="text" class="form-control " name="email" placeholder="Почта" id="email"
                                            value="{{old('email')}}">
                                        @error('email')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="first_name">Имя </label>
                                        <input type="text" class="form-control " name="first_name" placeholder="Имя" id="first_name"
                                            value="{{old('first_name')}}">
                                        @error('first_name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="last_name">Фамилия</label>
                                        <input type="text" class="form-control " name="last_name" placeholder="Фамилия" id="last_name"
                                            value="{{old('last_name')}}">
                                        @error('last_name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="father_name">Отчество <span class="text-muted">(если есть)</span></label>
                                        <input type="text" class="form-control " name="father_name" placeholder="Отчество" id="father_name"
                                            value="{{old('father_name')}}">
                                        @error('father_name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="age">Возраст</label>
                                        <input type="number" class="form-control " name="age" placeholder="Возраст" id="age"
                                            value="{{old('age')}}">
                                        @error('age')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="password">Пароль</label>
                                        <input type="text" class="form-control " name="password" placeholder="Пароль" id="password"
                                            value="{{old('password')}}">
                                        @error('password')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="gender_id">Пол</label>
                                        <select class="form-control " name="gender_id" id="gender_id">
                                            <option value="0" disabled selected>пол</option>
                                            @foreach($genders as $gender)
                                                <option value="{{ $gender->id }}"
                                                        @if(old('gender_id') == $gender->id) selected @endif>{{ $gender->name }}</option>
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
                                                <option value="{{$role->id}}"
                                                        @if(old('role_id') == $role->id) selected @endif>{{$role->name}}</option>
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
                                                <option value="{{$occupation->id}}"
                                                        @if(old('occupation_id') == $occupation->id) selected @endif>{{$occupation->name}}</option>
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
                                                <option value="{{$track->id}}"
                                                        @if(old('track_id') == $track->id) selected @endif>{{$track->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('occupation_id')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
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
                                                value="{{ old('tg_name') }}">
                                        </div>
                                        @error('tg_name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                                        <label for="vk_url">Ссылка на ВКонтакте</label>
                                        <input type="text" class="form-control" name="vk_url"
                                            placeholder="vk url" id="vk_url" aria-describedby="vk_url_addon"
                                            value="{{ old('vk_url') }}">
                                        @error('vk_url')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                            </div>
                                <hr>

                                    {{-- avatar image --}}
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-4 text-right">
                                            <div class="row">
                                                <img src="" class="col-12 rounded img-fluid img-thumbnail mb-2 preview_avatar"
                                                    height="100" alt="новый аватар пользователя">
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
                                <input type="submit" class="btn btn-primary  col-sm-12" value="Создать">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

@endsection

@push('script')
    <script>
        let input = document.querySelector('.custom-file-input');
        let preview = document.querySelector(".preview_avatar")
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
