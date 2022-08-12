@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Добавление роли</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.handbook.index')}}">Справочник</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.handbook.roles.index')}}">Роли</a></li>
                            <li class="breadcrumb-item active">Добавление роли</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="col-4">
            <form action="{{route('admin.handbook.roles.store')}}" method="post">
                @csrf
                <div class="form-group ml-3 ">
                    <label for="exampleInputEmail1">Введите роль</label>
                    <input type="text" class="form-control" id="gender" name="name" placeholder="Роль">
                    @error('name')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Создать">
            </form>
        </div>
    </div>


@endsection
