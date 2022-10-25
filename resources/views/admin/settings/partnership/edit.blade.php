@extends('admin.layouts.main')


@section('content')



    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Изменение страницы партнёрства</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.partnership.index')}}">Управление
                            страницей партнерство</a></li>
                    <li class="breadcrumb-item">Изменение страницы партнёрство</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        @if (session('success'))
            <div class="m-3 alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('error') }}
            </div>
        @endif
        <div class="row mr-3 ml-3">
            <div class="col-sm-12 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.settings.partnership.update', $partnership->id)}}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group ">
                                <label for="title">Заголовок</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{$partnership->title}}" placeholder="Заголовок">
                                @error('title')
                                <div class="text-danger">{{$message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="summernote">Описание</label>
                                <textarea id="summernote" name="body">{{ $partnership->body }}</textarea>
                                @error('body')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-success  col-sm-12" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
