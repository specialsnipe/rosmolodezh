@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Изменение статьи</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.partnership.index')}}">Управление страницей Партнёрство</a></li>
                    <li class="breadcrumb-item">Изменение статьи</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="col-6 ml-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.settings.partnership.item.update', [$partnership->id, $partnershipItem->id]) }}"
                    method="post">
                        @csrf
                        @method('put')
                        <div class="form-group w-50">
                            <label for="exampleInputEmail1">Заголовок</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror " id="gender" name="title" placeholder="Заголовок" value="{{ $partnershipItem->title }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="summernote">Описание</label>
                            <textarea  id="summernote" name="body">{{ $partnershipItem->body }}</textarea>
                            @error('body')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <input type="submit" class="btn btn-success col-sm-12" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
