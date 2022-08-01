@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-sm-6">
                        <h1 class="ml-3">{{$user->login}} @if(auth()->user()->id == $user->id)
                                <span class="text-muted">(Это вы)</span>
                            @endif</h1>
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
                        <img class="card-img-top" src="{{ asset($user->avatar_medium_path) }}"
                             alt="Аватарка пользователя">
                    </div>
                    <table class="table table-head-fixed text-nowrap col-sm-12 col-md-8 ">
                        <tbody>
                        <tr>
                            <th class="col-sm-4 col-md-2">Статус:</th>
                            <td class="col-sm-8  col-md-10"> @if(isset($user->deleted_at))
                                    <span class="badge badge-danger">Удалён</span>
                                @else
                                    <span class="badge badge-success">Активен</span>
                                @endif</td>
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
                            <th>Выбранное направление</th>
                            @if($user->tracks)

                                @forelse($user->tracks as $track)
                                    <td>{{$track->title}} </td>
                                @empty
                                    <td>Направление не выборано</td>
                                @endforelse

                            @endif
                        </tr>
                        <tr>
                            <th>Контактный номер</th>
                            <td>{{$user->phone}}</td>
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



            <div class="" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a class="btn btn-info mr-2 col-12" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne" aria-expanded="false"
                               aria-controls="collapseOne">
                                Ответы учеников <i
                                    class="fa fa-eye"></i>
                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="card-block">

                                <div class="card-body table-responsive ">
                                    <table class="table_sort table table-hover table-head-fixed text-nowrap">

                                                @forelse($user->tracks as $track)
                                                    <div class="card" id="{{'accordion'. $track->id }}"
                                                         role="tablist" aria-multiselectable="true">
                                                        <div class="card-header row align-items-center" role="tab"
                                                             style="padding:20px; display: flex; justify-content: space-between">

                                                            <h5 class="mb-0 col-sm-12 col-lg-8 header-of-card ">
                                                                    <span data-toggle="collapse"
                                                                          data-parent="{{'#accordion'. $track->id }}"
                                                                          aria-expanded="true"
                                                                          aria-controls="collapseOne">
                                                                        {{ $loop->index + 1 }} | Траектория - "{{ $track->title }}" (id:{{$track->id}})
                                                                    </span>
                                                            </h5>
                                                        </div>



                                                    </div>
                                                @empty
                                                    направление не выбрано
                                                @endforelse

                                    </table>

                            </div>
                        </div>
                    </div>
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
