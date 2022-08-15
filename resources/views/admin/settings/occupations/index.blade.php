@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Управление занятостями</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item">Управление занятостями</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
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
                            @forelse($occupations as $occupation)
                                <tr>
                                    <td>{{$occupation->id}}</td>
                                    <td>{{$occupation->name}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{ route('admin.settings.occupations.edit', $occupation->id) }}"
                                               class="btn btn-block btn-success btn-sm ">Изменить</a>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{route('admin.settings.occupations.destroy', $occupation->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-block btn-danger btn-sm">Удалить</button>
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
                    <a href="{{route('admin.settings.occupations.create')}}"
                       class="btn btn-block btn-primary">Добавить</a>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

@endsection
