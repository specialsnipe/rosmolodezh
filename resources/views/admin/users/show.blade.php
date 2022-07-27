@extends('admin.layouts.main')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-sm-6">
                    <h1 class="ml-3">{{$user->login}} @if(auth()->user()->id == $user->id) <span class="text-muted">(Это вы)</span> @endif</h1>
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

    <section class="content m-3">
        <div class="card ">
            <div class="card-body row">
                <div class="col-sm-12 col-md-4">
                    <img class="card-img-top" src="{{ asset($user->avatar_medium_path) }}" alt="Аватарка пользователя">
                </div>
                <table class="table table-head-fixed text-nowrap col-sm-12 col-md-8 ">
                    <tbody>
                        <tr>
                            <th class="col-sm-4 col-md-2">Статус:</th>
                            <td class="col-sm-8  col-md-10"> @if(isset($user->deleted_at)) <span class="badge badge-danger">Удалён</span> @else  <span class="badge badge-success">Активен</span> @endif</td>
                        </tr>
                        <tr>
                            <th class="col-sm-4 col-md-2">ID</th>
                            <td class="col-sm-8  col-md-10">{{$user->id}}</td>
                        </tr>
                        <tr>
                            <th>Логин</th>
                            <td>{{$user->login}}</td>
                        </tr>
                        <tr>
                            <th>ФИО</th>
                            <td>{{$user->last_name}} {{$user->first_name}} {{$user->father_name}} </td>
                        </tr>
                        <tr>
                            <th>Возраст</th>
                            <td>{{$user->age}}</td>
                        </tr>
                        <tr>
                            <th>Пол</th>
                            <td>{{$user->gender->title}}</td>
                        </tr>
                        <tr>
                            <th>Деятельность</th>
                            <td>{{$user->occupation->name}}</td>
                        </tr>
                        <tr>
                            <th>Роль</th>
                            <td>{{$user->role->name}}</td>
                        </tr>
                        <tr>
                            <th>Почта</th>
                            <td>{{$user->email}}
                                @if(isset($user->email_verified_at))
                                    <span class="text-muted">(почта подтверждена: {{ $user->email_verified_at }})</span>
                                @else
                                    <span class="text-danger"> (почта не подтверждена)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Телеграм</th>
                            <td><a target="_blank" href="{{ $user->tg_url}}"> {{ $user->tg_name }} </a>
                                @if(isset($user->tg_id))
                                    <span class="text-muted">({{ $user->tg_id }})</span>
                                @else
                                    <span class="text-danger"> (пользователь ещё не запустил бота)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Вконтакте</th>
                            <td>{{$user->vk_rul}}</td>
                        </tr>
                        <tr>
                            <th>Комментарий</th>
                            <td>{{$user->about}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row ">
            <div class="col-sm-6 col-xl-4 mt-3">
                <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-info col-12">Изменить</a>
            </div>
            @if(auth()->user()->id != $user->id)
            <div class="col-sm-6 col-xl-4 mt-3">
                @if (isset($user->deleted_at))


                <form action="{{route('admin.users.changeStatus', $user->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <input type="submit" class="btn btn-success col-12 " value="Восстановить">
                </form>
                @else
                <form action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger col-12 " value="Деактивировать">
                </form>
                @endif
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-4 mt-3">
                <a href="{{ url()->previous() }}" class="btn btn-primary col-12"> Назад</a>
            </div>
        </div>

    </section>
</div>
</div>

@endsection
