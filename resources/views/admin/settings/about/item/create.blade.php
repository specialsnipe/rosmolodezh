@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Добавление новой статьи</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.partnership.index')}}">Управление страницей Партнёрство</a></li>
                    <li class="breadcrumb-item">Добавление новой статьи</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row ml-3 mr-3">
            <div class="col-sm-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.settings.partnership.item.store', $partnership->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Заголовок</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror " id="gender" name="title" placeholder="Заголовок" value="{{ old('title') }}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="summernote">Описание</label>
                                <textarea class="@error('body') is-invalid @enderror " id="summernote" name="body">{{ old('body') }}</textarea>
                                @error('body')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn btn-primary col-sm-12" value="Создать">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
