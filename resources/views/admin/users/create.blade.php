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
                            <li class="breadcrumb-item active">Создание пользователя</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group w-25">
                                <input type="text" class="form-control " name="login" placeholder="Логин"
                                       value="{{old('login')}}">
                                @error('login')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file" id="exampleInputFile"
                                               value="{{old('file')}}">
                                        <label class="custom-file-label" for="exampleInputFile">Выберите
                                            картинку</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group w-25">
                                <input type="text" class="form-control " name="email" placeholder="Почта"
                                       value="{{old('email')}}">
                                @error('email')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group w-25">
                                <input type="text" class="form-control " name="first_name" placeholder="Имя"
                                       value="{{old('first_name')}}">
                                @error('first_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-25">
                                <input type="text" class="form-control " name="last_name" placeholder="Фамилия"
                                       value="{{old('last_name')}}">
                                @error('last_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-25">
                                <input type="text" class="form-control " name="father_name" placeholder="Отчество"
                                       value="{{old('father_name')}}">
                                @error('father_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group w-25">
                                <input type="text" class="form-control " name="age" placeholder="Возраст"
                                       value="{{old('age')}}">
                                @error('age')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group w-25">
                                <input type="text" class="form-control " name="password" placeholder="Пароль"
                                       value="{{old('password')}}">
                                @error('password')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="w-25 mb-3">
                                <select class="form-control " name="gender_id">
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

                            <div class="w-25 mb-3">
                                <select class="form-control " name="role_id">
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

                            <div class="w-25 mb-3">
                                <select class="form-control " name="occupation_id">
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

                            <input type="submit" class="btn btn-primary mb-3" value="Добавить">
                        </form>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

@endsection
