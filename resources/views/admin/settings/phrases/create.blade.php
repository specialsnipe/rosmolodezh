@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Добавление фразы</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.phrases.index')}}">Фразы</a></li>
                            <li class="breadcrumb-item active">Добавление фразы</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        @if (session('success'))
            <div class="m-3 alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('success') }}
            </div>
        @endif
        <div class="col-4">
            <form action="{{route('admin.settings.phrases.store')}}" method="post">
                @csrf
                <div class="form-group ml-3 ">
                    <label for="exampleInputEmail1">Введите фразу</label>
                    <input type="text" class="form-control" id="gender" name="body" placeholder="Фраза">
                    @error('name')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Создать">
            </form>
        </div>
    </div>


@endsection
