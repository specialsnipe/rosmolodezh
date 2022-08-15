@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Пол</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                            <li class="breadcrumb-item active">Пол</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row m-3">
            <div class="col-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class=" table table-hover text-nowrap">
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
                                    <td><a href="{{route('admin.settings.genders.show',$gender->id)}}">{{$gender->name}}</a></td>
                                    <td>
                                        <div class="">
                                            <a href="{{ route('admin.settings.genders.edit', $gender->id) }}"
                                               class="btn btn-block btn-success btn-sm ">Изменить</a>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{route('admin.settings.genders.destroy',$gender->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-block btn-danger btn-sm">Удалить
                                            </button>
                                        </form>
                                    </td>
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
                <div class="col-3 mt-3">
                    <a href="{{route('admin.settings.genders.create')}}"
                       class="btn btn-block btn-primary">Добавить пол</a>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

@endsection
