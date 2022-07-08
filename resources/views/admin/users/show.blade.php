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
                            <li class="breadcrumb-item active">{{$user->login}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card-body table-responsive p-0 w-50">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{$user->id}}</td>
                        </tr>
                        <tr>
                            <td>Логин</td>
                            <td>{{$user->login}}</td>
                        </tr>
                        <tr>
                            <td>ФИО</td>
                            <td>{{$user->last_name}}{{$user->first_name}}{{$user->father_name}} </td>
                        </tr>
                        <tr>
                            <td>Возраст</td>
                            <td>{{$user->age}}</td>
                        </tr>
                        <tr>
                            <td>Пол</td>
                            <td>{{$user->gender->title}}</td>
                        </tr>
                        <tr>
                            <td>Деятельность</td>
                            <td>{{$user->occupation->name}}</td>
                        </tr>
                        <tr>
                            <td>Роль</td>
                            <td>{{$user->role->name}}</td>
                        </tr>
                        <tr>
                            <td>Маил</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>Телеграм</td>
                            <td>{{$user->tg_url}}</td>
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
            <div class="row mb-3">
                <div class="col-1 mt-3">
                    <a href="{{route('admin.users.edit',$user->id)}}"
                       class="btn btn-warning ">Изменить</a>
                </div>
                <div class="col-1 mt-3 mb-3">
                    <form action="{{route('admin.users.destroy',$user->id)}}"
                          method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger " value="Удалить">
                    </form>
                </div>
            </div>
        </section>
    </div>
    </div>

@endsection
