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
        <section class="m-3">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header" style="padding: 0">

                            @if($post->images->count() > 1)
                            <div class="myslider" id="{{ 'slider-' . $post->id }}">
                                <div class="slider__wrapper">
                                    <div class="slider__items">
                                        @foreach ($post->images as $image)
                                        <div class="slider__item">
                                            <div>
                                                <img src="{{ asset($image->imageMedium) }}"
                                                    class="d-block w-100 rounded" alt="..." height="500"
                                                    style="object-fit: cover; max-height: 100%">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <a class="slider__control slider__control_prev" href="#" role="button"
                                    data-slide="prev"></a>
                                <a class="slider__control slider__control_next" href="#" role="button"
                                    data-slide="next"></a>
                            </div>
                            @else
                                @foreach ($post->images as $image)
                                <img src="{{asset($image->imageMedium) }}" class="d-block w-100" alt="..."
                                    style="object-fit: cover; max-height: 100%">
                                @endforeach
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="text-bold card-title">{{ $post->title }}</h5>
                            <div class="card-text">
                                {{ $post->excerpt }}
                            </div>
                            <div class="card-text ">
                                {!! $post->body !!}
                            </div>
                            <div class="card-text ">Автор: {{$post->user->all_names}} • {{$date->translatedFormat('F')}}
                                {{$date->day}}, {{$date->year}} • {{$date->format('H:i')}} </div>
                            <div class="card-text">
                                <div class="row">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                        class="col-sm-12 col-md-4 col-lg-2 btn btn-success">Изменить</a>

                                    <span class="col-sm-12 col-md-4 col-lg-2 btn btn-danger" id="delete_post"
                                        role="button"> Удалить</span>
                                    <div class="d-none">
                                        <form action="{{route('admin.posts.destroy',$post->id)}}" method="POST"
                                            style="display: inline-block" id='delete_post_form'>
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">

                    <div class="card">
                        <div class="card-header">
                            <h5>Другие новости</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($posts as $other_post)

                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">{{ $other_post->title }}</div>
                                    <div class="card-text text-truncate">{{ $other_post->excerpt }}</div>
                                    <div class="card-text"> <a href="{{ route('admin.posts.show', $other_post->id) }}"
                                            class="btn btn-primary">Открыть</a></div>
                                </div>
                            </div>
                            @endforeach
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
        let deletePostBtn = document.querySelector('#delete_post')
        let deletePostForm = document.querySelector('#delete_post_form')
        deletePostBtn.addEventListener('click', function() {
            deletePostForm.submit();
        });

    });
</script>
@endpush
