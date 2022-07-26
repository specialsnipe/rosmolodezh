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
                            <li class="breadcrumb-item active">Справочник</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="card-body w-25">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Название</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        <a href="{{route('admin.roles.index')}}">Роли</a>
                    </td>
                </tr>
                <tr>

                    <td>
                        2
                    </td>
                    <td>
                        <a href="{{route('admin.occupations.index')}}">Занятость</a>
                    </td>
                </tr>
                <tr>

                    <td>
                        3
                    </td>
                    <td>
                        <a href="{{route('admin.genders.index')}}">Пол</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    </div>

@endsection
