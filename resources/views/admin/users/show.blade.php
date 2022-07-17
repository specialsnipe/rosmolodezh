@extends('admin.layouts.main')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$user->login}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Пользователи</a></li>
                        <li class="breadcrumb-item active">{{$user->login}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="card">
            <div class="card-body row">
                <div class="col-sm-12 col-md-4 col-xl-2">
                    <img class="card-img-top" src="{{ asset($user->avatar_original_path) }}" alt="Аватарка пользователя">
                </div>
                <table class="table table-head-fixed text-nowrap col-sm-12 col-md-8 col-xl-10">
                    <tbody>
                        <tr>
                            <th class="col-sm-4 col-md-2">ID</th>
                            <td class="col-sm-8  col-md-10">{{$user->id}}</td>
                        </tr>
                        <tr>
                            <th>Логин</td>
                            <td>{{$user->login}}</td>
                        </tr>
                        <tr>
                            <th>ФИО</td>
                            <td>{{$user->last_name}}{{$user->first_name}}{{$user->father_name}} </td>
                        </tr>
                        <tr>
                            <th>Возраст</td>
                            <td>{{$user->age}}</td>
                        </tr>
                        <tr>
                            <th>Пол</td>
                            <td>{{$user->gender->title}}</td>
                        </tr>
                        <tr>
                            <th>Деятельность</th>
                            <td>{{$user->occupation->name}}</td>
                        </tr>
                        <tr>
                            <th>Роль</td>
                            <td>{{$user->role->name}}</td>
                        </tr>
                        <tr>
                            <td>Почта</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>Телеграм</td>
                            <td>{{$user->tg_name}}</td>
                        </tr>
                        <tr>
                            <td>Вконтакте</td>
                            <td>{{$user->vk_rul}}</td>
                        </tr>
                        <tr>
                            <td>Комментарий</td>
                            <td>{{$user->about}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row ">
            <div class="col-sm-6 col-xl-4 mt-3">
                <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-warning col-12">Изменить</a>
            </div>
            <div class="col-sm-6 col-xl-4 mt-3">
                <form action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger col-12 " value="Удалить">
                </form>
            </div>
        </div>
    </section>
</div>
</div>

@endsection
