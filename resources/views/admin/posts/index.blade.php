@extends('admin.layouts.main')

@push('style')

<link rel="stylesheet" href="{{ asset('css/simple-adaptive-slider.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row m-2">
            <div class="col-sm-6">
                <h1 class="">Новости</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active">Новости</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <div class="row m-3">

        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
            <a href="{{route('admin.posts.create')}}" class="btn btn-block btn-primary">Добавить новость</a>
        </div>
    </div>

    <div class="row m-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id <i class="fa fa-sort-amount-up disabled"></i></th>
                                <th style="width: 200px">Название </th>
                                <th>Краткое описание </th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                                <th style="width: 200px">
                                    Управление
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>

                                    <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->id }}</a></td>
                                    <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>
                                    <td>
                                        <div class="text-truncate" style="width: 200px;">
                                        {!! $post->excerpt !!}</div>
                                    </td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>

                                <td>
                                    <a href="{{ route('admin.posts.show', $post->id) }}">
                                        <span class="btn btn-outline-info">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </a>
                                    <a href="{{ route('admin.posts.destroy', $post->id) }}">
                                        <span class=" btn btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}">
                                        <span class="btn btn-outline-success">
                                            <i class="fa fa-pen "></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            {{-- <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    @if($post->images->count() > 1)
                                    <div class="myslider" id="{{ 'slider-' . $post->id }}">
                                        <div class="slider__wrapper">
                                            <div class="slider__items">
                                                @foreach ($post->images as $image)
                                                <div class="slider__item">
                                                    <div>
                                                        <img src="{{ asset($image->thumbnail_image) }}"
                                                            class="d-block w-100" alt="..." height="200"
                                                            style="object-fit: cover">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <a class="slider__control slider__control_prev" href="#" role="button"
                                                data-slide="prev"></a>
                                            <a class="slider__control slider__control_next" href="#" role="button"
                                                data-slide="next"></a>
                                        </div>

                                    </div>
                                    @else
                                    @foreach ($post->images as $image)
                                    <img src="{{ asset($image->thumbnail_image) }}" class="d-block w-100" alt="..."
                                        height="200" style="object-fit: cover">
                                    @endforeach
                                    @endif
                                    <div class="card-body">
                                        <h5 class="text-bold card-title">{{ $post->title }}</h5>
                                        <div class="card-text text-truncate">
                                            {{ $post->excerpt }}
                                        </div>
                                        <div class="row mt-2">
                                            <a href="{{ route('admin.posts.show', $post->id) }}"
                                                class="col-12 btn btn-outline-primary mb-1">Открыть</a>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                class="col-12 btn btn-success">Изменить</a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="row m-3">
        <div class="card col-12">
            <div class="card-body">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script src="{{  asset('scripts/simple-adaptive-slider.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      // инициализация слайдеров
      let sliders = document.querySelectorAll('.myslider');
      if(sliders) {
        sliders.forEach(element => {
            var slider = new SimpleAdaptiveSlider('#'+element.id, {
                loop: true,
                autoplay: true,
                interval: 2000,
                swipe: true,
            });
        });
      }

    });
</script>
@endpush
