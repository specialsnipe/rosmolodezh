@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Пользователи</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Пользователи</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Responsive Hover Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                       placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="true"
                                   aria-controls="collapseOne">
                                    Фильтр по пользователям
                                </a>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                            <div class="card-block pt-2 pl-3">
                                <form action="" method="get">
                                    <div style="display: flex">
                                        @csrf
                                        <div class="form-group mr-3">

                                            <div style="display: flex;">
                                                <div class="mr-3">
                                                    <label for="name">Фамилия</label>
                                                    <input value="" type="text"
                                                           name="last_name"
                                                           class="form-control mb-2"
                                                           id="last_name"
                                                           placeholder="Фамилия">
                                                </div>

                                                <div class="mr-3">
                                                    <label for="region">Имя</label>
                                                    <input value="" type="text"
                                                           name="first_name"
                                                           class="form-control mb-2"
                                                           id="first_name"
                                                           placeholder="Регион">
                                                </div>
                                                <div class="mr-3">
                                                    <label for="region">Отчество</label>
                                                    <input value="" type="text"
                                                           name="father_name"
                                                           class="form-control mb-2"
                                                           id="father_name"
                                                           placeholder="Регион">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info mb-5">Применить фильтр</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>Аватар</th>
                            <th>ФИО</th>
                            <th>Занятость</th>
                            <th>Пол</th>
                            <th>Возраст</th>
                            <th>Роль</th>
                            <th>Майл</th>
                            <th>Траектория</th>
                            <th>Телеграм</th>
                            <th>Вконтакте</th>
                            <th>Комментарий</th>
                        </tr>
                        </thead>

                        @forelse($users as $user)
                            <tbody>
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><a href="{{route('admin.users.show', $user->id)}}">{{$user->login}}</a></td>
                                <td><img src="{{asset($user->avatar_thumbnail_path)}}" width=50px height=50px
                                         alt="image"></td>
                                <td style="display: flex; flex-direction: column">
                                    <span>
                                        {{$user->last_name}}
                                    </span>
                                    <span>
                                        {{$user->first_name}}
                                    </span>
                                    <span>
                                        {{$user->father_name}}
                                    </span>
                                </td>
                                <td>{{$user->occupation->name}}</td>
                                <td>{{$user->gender->name}}</td>
                                <td>{{$user->age}}</td>
                                <td>{{$user->role->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->tg_url}}</td>
                                <td>{{$user->vk_url}}</td>
                                <td>{{$user->about}}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Постов нет</td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                </div>
                <div class="col-2 mt-3">
                    <a href="{{route('admin.users.create')}}"
                       class="btn btn-block btn-primary">Добавить пользователя</a>
                </div>
            </div>
        </div>
    </div>
@endsection
