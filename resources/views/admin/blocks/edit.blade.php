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
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.tracks.blocks.update',[$track->id, $block->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="title">Название блока</label>
                                    <input type="text" class="form-control " id="title" name="title" placeholder="Название" value="{{ $block->title }}">
                                    @error('title')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-12 col-md-3">
                                    <label for="date_start">Дата начала блока</label>
                                    <input type="date" class="form-control" name="date_start" value="{{ strftime('%Y-%m-%d', strtotime($block->date_start)) }}">
                                    @error('date_start')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <label for="date_end">Дата окончания блока</label>
                                    <input type="date" class="form-control" name="date_end" value="{{ strftime('%Y-%m-%d', strtotime($block->date_end)) }}">
                                    @error('date_end')
                                        <div class="text-danger">{{$message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12 ">
                                    <label for="summernote">Текст блока</label>
                                    <textarea id="summernote" name="body">{!! $block->body !!}</textarea>
                                    @error('body')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-3 text-right">
                                        <img src="{{ asset($block->image_original) }}" class="col-12 rounded img-fluid img-thumbnail mb-2 old_image"
                                            height="100" alt="Старое изображение блока">
                                </div>

                                <div class="col-sm-12 col-md-3 text-right">
                                        <img src="" class="col-12 rounded img-fluid img-thumbnail mb-2 preview_image"
                                            height="100" alt="Превью изображения блока">
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="exampleInputFile2">Загрузите изображение блока</label>
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

@push('script')
    <script>
        let input = document.querySelector('.custom-file-input');
        let preview = document.querySelector(".preview_image")
        input.addEventListener('change', function(event) {
            if(event.target.files.length > 0){
                let src = URL.createObjectURL(event.target.files[0]);
                preview.src = src;
                preview.style.display = "block";
            }
        })

        preview.addEventListener('click', function () {
            input.click();
        })
    </script>
@endpush
