@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ответ на упражнение: {{$exercise->title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Роли</a></li>
                            <li class="breadcrumb-item active">Ответ на упражнение: {{$exercise->title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="col-4">
            <form action="{{route('admin.exercises.answers.store', $exercise->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group ml-3">
                    <label for="name">Название</label>
                    <input type="text" class="form-control " name="title" placeholder="Название"
                           id="name" value="{{old('title')}}">
                    @error('title')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group ml-3 ">
                    <label for="exampleInputEmail1">Ответ на упражнение</label>
                    <textarea id="summernote" name="body">{{old('body')}}</textarea>
                    @error('body')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file[]" id="image"
                                   value="{{old('file')}}" multiple>
                            <label class="custom-file-label" for="exampleInputFile">Загрузите файлы</label>
                        </div>
                    </div>

                    @error('file')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                    @if($errors->has('file.*'))
                        @foreach($errors->get('file.*') as $error)
                            @foreach($error as $message)
                                <div class="text-danger">{{ $message }}</div>
                            @endforeach
                        @endforeach
                    @endif
                </div>

                <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Отправить ответ">
            </form>
        </div>
    </div>


@endsection
