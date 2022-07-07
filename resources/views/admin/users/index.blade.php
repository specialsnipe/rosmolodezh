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
        <div class="" row>
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>ФИО</th>
                            <th>Возраст</th>
                            <th>Деятельность</th>
                            <th>Пол</th>
                            <th>Роль</th>
                            <th>Майл</th>
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
                                <td>{{$user->role->name}}</td>
                                <td>{{$user->mail}}</td>
                                <td></td>
                                <td>Вконтакте</td>
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
            </div>
        </div>
    </div>
@endsection
