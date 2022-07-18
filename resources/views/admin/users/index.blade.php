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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Главная</a></li>
                        <li class="breadcrumb-item active">Пользователи</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <div class="m-3" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne">
                                Фильтр по пользователям
                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="card-block">
                            <form action="{{route('admin.users.index')}}" method="get" class="p-3">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 ">
                                        <label for="last_name">Фамилия</label>
                                        <input value="{{request()->last_name}}" name="last_name"
                                            class="form-control mb-2" id="last_name" placeholder="Фамилия">
                                    </div>

                                    <div class="col-sm-12 col-md-4 col-lg-3 ">
                                        <label for="first_name">Имя</label>
                                        <input value="{{request()->first_name}}" name="first_name"
                                            class="form-control mb-2" id="first_name" placeholder="Имя">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-3 ">
                                        <label for="father_name">Отчество</label>
                                        <input value="{{request()->father_name}}" name="father_name"
                                            class="form-control mb-2" id="father_name" placeholder="Отчество">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-3 ">
                                        <label>Роль</label>
                                        <select class="select2" name="role_id[]" multiple="multiple"
                                            data-placeholder="Выберете роль" style="width: 100%;">
                                            @foreach($roles as $role)
                                            <option {{is_array(request()->role_id)&&
                                                in_array($role->id,request()->role_id)?'selected':''}}
                                                value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-3 ">
                                        <label>Траектория</label>
                                        <select class="select2" name="track_id[]" multiple="multiple"
                                            data-placeholder="Выберете траекторию" style="width: 100%;">
                                            @foreach($tracks as $track)
                                            <option {{is_array(request()->track_id)&&
                                                in_array($track->id,request()->track_id)?'selected':''}}
                                                value="{{$track->id}}">{{$track->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info">Применить фильтр</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-3">
                <a href="{{route('admin.users.create')}}" class="col-sm-12 col-md-4 btn btn-primary">Добавить
                    пользователя</a>
            </div>

            <div class="card m-3">
                <div class="card-head p-3">
                    <h3 class="card-title">Записи пользователей зарегиестрированных на сайте</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Аватар</th>
                                <th>ФИО</th>
                                <th>Занятость</th>
                                <th>Роль</th>
                                <th>Траектория</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{$user->id}}</td>
                                    <td><img src="{{asset($user->avatar_thumbnail_path)}}" width=50px height=50px
                                            alt="image">
                                    </td>
                                    <td>
{{--                                    <td style="display: flex; flex-direction: column">--}}
{{--                                        <a href="{{route('admin.users.show', $user->id)}}">--}}
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
                                    <td><span
                                            style="padding: 5px 10px; background: #72c07d; border-radius: 5px">{{$user->role->name}}</span>
                                    </td>
                                    <td>@forelse($user->tracks as $track) <a
                                            href="{{route('admin.tracks.show', $track->id)}}"
                                            style="padding: 5px 10px; background: #5ebff5; border-radius: 5px">{{$track->title}}</a>
                                        @empty <span>Нет траектории</span> @endforelse</td>
                                </tr>
                                <tr class="expandable-body d-none">
                                    <td colspan="10">
                                        <table class="table-head-fixed text-nowrap">
                                            <thead>
                                                <td class="mr-3 mt-3 mb-3">логин</td>
                                                <td class="mr-3 mt-3 mb-3">пол</td>
                                                <td class="mr-3 mt-3 mb-3">возраст</td>
                                                <td class="mr-3 mt-3 mb-3">почта</td>
                                                <td class="mr-3 mt-3 mb-3">телеграм логин</td>
                                                <td class="mr-3 mt-3 mb-3">телеграм id</td>
                                                <td class="mr-3 mt-3 mb-3">вконтакте</td>
                                                <td class="mr-3 mt-3 mb-3">информация</td>
                                            </thead>
                                            <tbody>
                                                <td class="mr-3 mt-3 mb-3"><a href="{{route('admin.users.show', $user->id)}}">{{$user->login}}</a>
                                                </td>
                                                <td class="mr-3 mt-3 mb-3">{{$user->gender->name}} </td>
                                                <td class="mr-3 mt-3 mb-3">{{$user->age}} </td>
                                                <td class="mr-3 mt-3 mb-3">{{$user->age}} </td>
                                                <td class="mr-3 mt-3 mb-3">{{$user->tg_name}} </td>
                                                <td class="mr-3 mt-3 mb-3">{{$user->tg_id}} </td>
                                                <td class="mr-3 mt-3 mb-3">{{$user->tg_url}} </td>
                                                <td class="mr-3 mt-3 mb-3">{{$user->about}} </td>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td></td>
                                    <td>Пользователей нет</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- * Filter block --}}

            {{-- @livewire('users-component') --}}

            <div class="card m-3 p-3">
                    {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
@livewireScripts
@endpush
