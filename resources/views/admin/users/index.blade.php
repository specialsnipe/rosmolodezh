@extends('admin.layouts.main')


@push('style')
    @livewireScripts
@endpush

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
                {{-- <div id="accordion" role="tablist" aria-multiselectable="true">

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
                                <form action="{{route('admin.users.index')}}" method="get">
                                        <div class="form-group mr-3">
                                            <div style="display: flex;">
                                                <div class="mr-3">
                                                    <label for="last_name">Фамилия</label>
                                                    <input value="{{request()->last_name}}"
                                                           name="last_name"
                                                           class="form-control mb-2"
                                                           id="last_name"
                                                           placeholder="Фамилия">
                                                </div>

                                                <div class="mr-3">
                                                    <label for="first_name">Имя</label>
                                                    <input value="{{request()->first_name}}"
                                                           name="first_name"
                                                           class="form-control mb-2"
                                                           id="first_name"
                                                           placeholder="Имя">
                                                </div>
                                                <div class="mr-3">
                                                    <label for="father_name">Отчество</label>
                                                    <input value="{{request()->father_name}}"
                                                           name="father_name"
                                                           class="form-control mb-2"
                                                           id="father_name"
                                                           placeholder="Отчество">
                                                </div>

                                                <div class="mr-3">
                                                    <label>Роль</label>
                                                    <select class="select2" name="role_id[]" multiple="multiple"
                                                            data-placeholder="Выберете роль" style="width: 100%;">
                                                        @foreach($roles as $role)
                                                            <option
                                                                {{is_array(request()->role_id)&& in_array($role->id,request()->role_id)?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mr-3">
                                                    <label>Траектория</label>
                                                    <select class="select2" name="track_id[]" multiple="multiple"
                                                            data-placeholder="Выберете траекторию" style="width: 100%;">
                                                        @foreach($tracks as $track)
                                                            <option
                                                                {{is_array(request()->track_id)&& in_array($track->id,request()->track_id)?'selected':''}} value="{{$track->id}}">{{$track->title}}</option>
                                                        @endforeach
                                                    </select>
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
                                <td><span style="padding: 5px 10px; background: #72c07d; border-radius: 5px">{{$user->role->name}}</span></td>
                                <td>{{$user->email}}</td>
                                <td>@forelse($user->tracks as $track) <a href="{{route('admin.tracks.show', $track->id)}}" style="padding: 5px 10px; background: #5ebff5; border-radius: 5px">{{$track->title}}</a> @empty <span>Нет траектории</span> @endforelse</td>
                                <td>{{$user->tg_url}}</td>
                                <td>{{$user->vk_url}}</td>
                                <td>{{$user->about}}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Пользователе нет</td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                </div> --}}
                @livewire('users-component')
                <div class="col-2 mt-3">
                    <a href="{{route('admin.users.create')}}"
                       class="btn btn-block btn-primary">Добавить пользователя</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    @livewireScripts
@endpush
