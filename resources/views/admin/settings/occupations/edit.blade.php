@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Изменение занятости: {{ $occupation->name }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.roles.index')}}">Занятости</a></li>
                            <li class="breadcrumb-item active">Изменение занятости: {{ $occupation->name }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="col-4">
            <form action="{{route('admin.settings.occupations.update', $occupation->id)}}" method="post">
                @csrf
                @method('patch')
                <div class="form-group ml-3 ">
                    <label for="exampleInputEmail1">Введите занятость</label>
                    <input type="text" class="form-control" id="gender" name="name" value="{{$occupation->name}}" placeholder="Занятость">
                    @error('name')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Изменить">
            </form>
        </div>
    </div>


@endsection
