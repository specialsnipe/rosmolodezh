@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Справочник</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Роли</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-4">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="">Роли</h4>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">



                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        {{--                                <td><a href="{{route('admin.genders.show',$role->id)}}">v</a></td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td>Ролей нет</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{--                <div class="col-2 mt-3">--}}
                    {{--                    <a href="{{route('admin.posts.create')}}"--}}
                    {{--                       class="btn btn-block btn-primary">Добавить пол</a>--}}
                    {{--                </div>--}}
                    <!-- /.card -->
                </div>
            </div>
            <div class="col-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 >Занятость</h4>
                            <div class="card-tools">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($occupations as $occupation)
                                    <tr>
                                        <td>{{$occupation->id}}</td>
                                        <td>{{$occupation->name}}</td>
                                        {{--                                    <td><a href="{{route('admin.occupations.show',$occupation->id)}}">{{$occupation->name}}</a></td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td>Таблица пуста</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{--                <div class="col-2 mt-3">--}}
                    {{--                    <a href="{{route('admin.posts.create')}}"--}}
                    {{--                       class="btn btn-block btn-primary">Добавить пол</a>--}}
                    {{--                </div>--}}
                    <!-- /.card -->
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h4>Пол</h4>
                            <div class="card-tools">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($genders as $gender)
                                    <tr>
                                        <td>{{$gender->id}}</td>
                                        <td>
                                            {{$gender->name}}
                                        </td>
                                        {{--                                    <td><a href="{{route('admin.genders.show',$gender->id)}}">{{$gender->name}}</a></td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td>Таблица пуста</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{--                <div class="col-2 mt-3">--}}
                    {{--                    <a href="{{route('admin.posts.create')}}"--}}
                    {{--                       class="btn btn-block btn-primary">Добавить пол</a>--}}
                    {{--                </div>--}}
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </div>

@endsection
