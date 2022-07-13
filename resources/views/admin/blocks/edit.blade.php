@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Изменение блока: "{{$block->title}}"</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.index')}}">Направления</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.show', $track->id)}}">{{ $track->title }}</a></li>
                            <li class="breadcrumb-item active">Изменение блока: "{{$block->title}}"</li>
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
                        <form action="{{route('admin.tracks.blocks.update',[$track->id, $block->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group w-50">
                                <label for="title">Название блока</label>
                                <input type="text" class="form-control " id="title" name="title" placeholder="Название" value="{{$block->title}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <td style="display: flex; flex-direction: column">
                                <img src="{{asset($block->image_thumbnail) }}" alt="" width="100px">
                            </td>
                            <div class="form-group w-50">
                                <label for="exampleInputFile2">Загрузите иконку блока</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="exampleInputFile"
                                               value="{{old('image')}}" multiple>
                                        <label class="custom-file-label" for="exampleInputFile2">Выберите
                                            картинку</label>
                                    </div>
                                </div>
                                @error('image')
                                <div class="text-danger">{{$message}}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="summernote">Текст блока</label>
                                <textarea id="summernote" name="body">{{$block->body}}</textarea>
                                @error('body')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary" value="Изменить">
                        </form>
                    </div>

                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
