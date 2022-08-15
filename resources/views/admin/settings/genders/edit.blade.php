@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Изменение пола: {{ $gender->name }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.genders.index')}}">Управление полами</a></li>
                    <li class="breadcrumb-item">Изменение пола: {{ $gender->name }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="col-4">
            <form action="{{route('admin.settings.genders.update', $gender->id)}}" method="post">
                @csrf
                @method('patch')
                <div class="form-group ml-3 ">
                    <label for="exampleInputEmail1">Введите пол</label>
                    <input type="text" class="form-control" id="gender" name="name" value="{{$gender->name}}" placeholder="Пол">
                    @error('name')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Изменить">
            </form>
        </div>
    </div>


@endsection
