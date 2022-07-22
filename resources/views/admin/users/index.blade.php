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
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                @livewire('table-user-component',['user'=>$user, 'active'=> $user->active])
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
