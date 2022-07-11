@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование новости "{{$post->title}}"</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">{{$post->title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('admin.posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group w-50">
                                <label for="name" >Название новости</label>
                                <input type="text" class="form-control " name="title" placeholder="Название" id="name"
                                       value="{{$post->title}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Картинки для новости</label>
                                <td>
                                    <div class="image_container m-3">
                                        @foreach($post->images as $image)
                                            <img src="{{ $image->url }}" alt="" width="100px">
                                        @endforeach</div>

                                </td>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file[]" id="image"
                                               value="{{old('file')}}" multiple>
                                        <label class="custom-file-label" for="exampleInputFile">Выберите
                                            картинку</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
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
                                {{--                                @if($errors->all())--}}
                                {{--                                    {{ print_r($errors->all()) }}--}}
                                {{--                                    @foreach($errors->all() as $error)--}}
                                {{--                                        <div class="text-danger">{{$error}}</div>--}}
                                {{--                                    @endforeach--}}
                                {{--                                @endif--}}
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Краткое описание</label>
                                <textarea class="form-control" id="excerpt" name="excerpt">{{$post->excerpt}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="summernote">Основной текст статьи</label>
                                <textarea id="summernote" name="body">{{$post->body}}</textarea>
                            </div>
                            @error('body')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <input type="submit" class="btn btn-primary" value="Добавить">
                            {{--                            @dd($errors->all())--}}
                        </form>
                    </div>


                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    </div>


@endsection
