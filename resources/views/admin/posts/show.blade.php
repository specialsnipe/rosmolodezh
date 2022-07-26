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
                        <h1 class="m-0">{{$post->title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">Новости</a></li>
                            <li class="breadcrumb-item active">{{$post->title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
                <p class="ml-2">Автор: {{$post->user->all_names}} • {{$date->translatedFormat('F')}} {{$date->day}}, {{$date->year}} • {{$date->format('H:i')}} </p>
            <section class="m-3">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-8">

                        <div class="card">
                            @if($post->images->count() > 1)
                            <div class="card-img-top">
                                <div class="myslider" id="{{ 'slider-' . $post->id }}">
                                    <div class="slider__wrapper">
                                        <div class="slider__items">
                                            @foreach ($post->images as $image)
                                                <div class="slider__item">
                                                    <div>
                                                        <img src="{{ asset($image->original_image) }}" class="d-block w-100 rounded" alt="..." height="500" style="object-fit: cover">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a class="slider__control slider__control_prev" href="#" role="button" data-slide="prev"></a>
                                    <a class="slider__control slider__control_next" href="#" role="button" data-slide="next"></a>
                                </div>
                            </div>
                            @else
                                @foreach ($post->images as $image)
                                    <img src="{{ asset($image->thumbnail_image) }}" class="d-block w-100" alt="..." height="500" style="object-fit: cover">
                                @endforeach
                            @endif
                            <div class="card-body">
                                <h5 class="text-bold card-title">{{ $post->title }}</h5>
                                <div class="card-text">
                                    {{ $post->excerpt }}
                                </div>
                                <div class="card-text ">
                                    {!! $post->body !!}
                                </div>
                                <div class="row">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="col-sm-12 col-md-2 btn btn-success">Изменить</a>

                                    <div class="col-sm-12 col-md-2">
                                        <form action="{{route('admin.posts.destroy',$post->id)}}"
                                            method="POST" style="display: inline-block" >
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="col-12 btn btn-danger " value="Удалить">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>





@endsection

@push('script')

<script src="{{  asset('scripts/simple-adaptive-slider.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      // инициализация слайдера
      let sliderblock = document.querySelector('.myslider');
      if (sliderblock) {
        var slider = new SimpleAdaptiveSlider('.myslider', {
            loop: true,
            autoplay: true,
            interval: 2000,
            swipe: true,
        });
      }

    });
</script>
@endpush
