@extends('admin.layouts.main')

@push('style')

<link rel="stylesheet" href="{{ asset('css/simple-adaptive-slider.min.css') }}">
@endpush

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
                            <div class="col-12">
                                <label for="name">Название новости</label>
                                <input type="text" class="form-control " name="title" placeholder="Название" id="name"
                                    value="{{old('title')}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>


                            {{-- @if($errors->all())--}}
                            {{-- {{ print_r($errors->all()) }}--}}
                            {{-- @foreach($errors->all() as $error)--}}
                            {{-- <div class="text-danger">{{$error}}</div>--}}
                            {{-- @endforeach--}}
                            {{-- @endif--}}
                        </div>
                        <div class="form-group">

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file[]" id="image"
                                        value="{{old('file')}}" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Выберите
                                        картинку</label>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="previews-container">
                                    <label for="">Превью загруженной картинки</label>
                                    <div class="image_container text-right mb-2">
                                        <div class="myslider">
                                            <div class="slider__wrapper">
                                                <div class="slider__items">
                                                    <div class="slider__item">
                                                        <div>
                                                            <img src="" class="d-block w-100"
                                                                alt="..." height="400" style="object-fit: cover">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="slider__control slider__control_prev" href="#" role="button" data-slide="prev"></a>
                                            <a class="slider__control slider__control_next" href="#" role="button" data-slide="next"></a>
                                        </div>

                                        <span class="image-text text-muted"></span>
                                    </div>
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
<script src="{{  asset('scripts/simple-adaptive-slider.min.js') }}"></script>
<script>

    let input = document.querySelector('.custom-file-input');
    let sliderItems = document.querySelector(".slider__items");
    input.addEventListener('change', function(event) {

        sliderItems.innerHTML = '';
        if(event.target.files.length > 0){
            let imageText = document.querySelector('.image-text');

            if (event.target.files.length > 1) {
                imageText.innerHTML = '* Загруженные изображения (слайдер)'
            } else {
                imageText.innerHTML = '* Загруженное изображение';
                sliderItems.style.transform = '';
            }

            for (let i = 0; i < event.target.files.length; i++) {
                const element = event.target.files[i];

                let sliderItem = document.createElement('div');
                sliderItem.classList.add('slider__item');
                sliderItems.appendChild(sliderItem);

                let innerSlider = document.createElement('div');
                sliderItem.appendChild(innerSlider);

                let sliderImage = document.createElement('img');
                sliderImage.classList.add('d-block');
                sliderImage.classList.add('w-100');
                sliderImage.height = 400;
                sliderImage.style.objectFit = 'cover';
                innerSlider.appendChild(sliderImage);

                let src = URL.createObjectURL(element);
                sliderImage.src = src;
                sliderImage.style.display = "block";
            }
        }
        var slider = new SimpleAdaptiveSlider('.myslider', {
            loop: true,
            autoplay: true,
            interval: 2000,
            swipe: true,
        });
    })
</script>
@endpush
