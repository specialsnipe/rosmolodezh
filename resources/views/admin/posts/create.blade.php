@extends('admin.layouts.main')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header m-3">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h1 class="m-0">Cоздание новой публикации</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                        <li class="breadcrumb-item active">Новости</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="card row">
                <div class="card-header">
                    <h3>Создание новости</h3>
                </div>
                <div class="card-body col-12">
                    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6">
                                <label for="name">Название новости</label>
                                <input type="text" class="form-control " name="title" placeholder="Название" id="name"
                                    value="{{old('title')}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <label for="image">Картинки для новости</label>
                                <div class="input-group">
                                    <div class="fallback">
                                        <input type="file" class="custom-file-input" name="file[]" id="image" multiple>
                                    </div>
                                    <label class="custom-file-label" for="image">Выберите
                                        картинку</label>
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
                            {{-- @if($errors->all())--}}
                            {{-- {{ print_r($errors->all()) }}--}}
                            {{-- @foreach($errors->all() as $error)--}}
                            {{-- <div class="text-danger">{{$error}}</div>--}}
                            {{-- @endforeach--}}
                            {{-- @endif--}}
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Превью загруженной картинки</label>
                                <div class="row ml-1 previews-container">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Краткое описание</label>
                            <textarea class="form-control" id="excerpt" name="excerpt">{{old('excerpt')}}</textarea>

                            @error('excerpt')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="summernote">Основной текст статьи</label>
                            <textarea id="summernote" name="body">{{old('body')}}</textarea>

                            @error('body')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <input type="submit" class="col-sm-12 col-md-6 col-lg-3 btn btn-primary" value="Добавить">
                        {{-- @dd($errors->all())--}}
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
    let imgInp = document.querySelector('#image')
    let previewContainer = document.querySelector('.previews-container')
    imgInp.onchange = evt => {
        const [files] = imgInp.files;
        if (files) {
            let oldImages = document.querySelectorAll('.preview-img');
            if(oldImages) {
                oldImages.forEach(element => {
                    element.parentNode.removeChild(element);
                });
            }
            for (var i = 0; i < imgInp.files.length; i++) {
                let file = imgInp.files[i];
                let reader = new FileReader();
                reader.onload = (e)=>{
                    let preview = document.createElement('img');
                    // preview.height = '200px';
                    preview.alt = 'Превью изображения';
                    preview.classList.add('preview-img');
                    preview.classList.add('rounded');
                    preview.classList.add('mr-3');
                    preview.id = 'imagePrev';
                    preview.src = e.target.result;
                    // preview.classList.add('rounded');
                    previewContainer.appendChild(preview);
                    preview.height ='200';
                }
                reader.readAsDataURL(file);
            }
        }

    }
</script>
@endpush
