@extends('admin.layouts.main')


@push('style')

<link rel="stylesheet" href="{{ asset('css/simple-adaptive-slider.min.css') }}">
@endpush

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
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.posts.update', $post->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Изменить название новости</label>
                            <input type="text" class="form-control " name="title" placeholder="Название" id="name"
                                value="{{$post->title}}">
                            @error('title')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Добавить другие картинки или оставить прежние</label>
                            <div class="image_container text-right mb-2">
                                @if($post->images->count() > 1)
                                <div class="myslider">
                                    <div class="slider__wrapper">
                                        <div class="slider__items">
                                            @foreach ($post->images as $image)
                                            <img src="{{ asset($image->medium_image) }}" class="d-block w-100" alt="..."
                                                height="400" style="object-fit: cover">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <span class="image-text text-muted">*старые изображения (слайдер)</span>
                        @else
                        <div class="myslider">
                            <div class="slider__wrapper">
                                <div class="slider__items">
                                    @foreach ($post->images as $image)
                                    <div class="slider__item">
                                        <div>
                                            <img src="{{ asset($image->thumbnail_image) }}"
                                                class="d-block w-100 single-image" alt="..." height="400"
                                                style="object-fit: cover">
                                        </div>
                                    </div>
                                    <div class="slider__item">
                                        <div>
                                            <img src="{{ asset($image->thumbnail_image) }}"
                                                class="d-block w-100 single-image" alt="..." height="400"
                                                style="object-fit: cover">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <span class="image-text text-muted">*старое изображение</span>
                        @endif
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file[]" id="image" value="{{old('file')}}"
                            multiple>
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
                {{-- @if($errors->all())--}}
                {{-- {{ print_r($errors->all()) }}--}}
                {{-- @foreach($errors->all() as $error)--}}
                {{-- <div class="text-danger">{{$error}}</div>--}}
                {{-- @endforeach--}}
                {{-- @endif--}}
            </div>
            <div class="form-group">
                <label for="excerpt">Изменить краткое описание</label>
                <textarea class="form-control" id="excerpt" name="excerpt">{{$post->excerpt}}</textarea>

                @error('excerpt')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="summernote">Изменить основной текст статьи</label>
                <textarea id="summernote" name="body">{{$post->body}}</textarea>
            </div>
            @error('body')
            <div class="text-danger">{{$message}}</div>
            @enderror
            <input type="submit" class="btn btn-primary" value="Изменить новость">
            {{-- @dd($errors->all())--}}
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

@push('script')
<script src="{{  asset('scripts/simple-adaptive-slider.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      // инициализация слайдера
        var slider = new SimpleAdaptiveSlider('.myslider', {
            loop: true,
            autoplay: true,
            interval: 2000,
            swipe: true,
        });
    });

    let input = document.querySelector('.custom-file-input');
    let sliderItems = document.querySelector(".slider__items");
    let singleImage = document.querySelector('.single-image');
    if (singleImage) {
        singleImage.parentNode.removeChild(singleImage);
    }
    input.addEventListener('change', function(event) {
        sliderItems.innerHTML = '';
        if(event.target.files.length > 0){
            let imageText = document.querySelector('.image-text');


            if (event.target.files.length > 1) {
                imageText.innerHTML = '* новые изображения (слайдер)'
            } else {
                imageText.innerHTML = '* новое изображение';
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

    // preview.addEventListener('click', function () {
    //     input.click();
    // })
</script>

@endpush
