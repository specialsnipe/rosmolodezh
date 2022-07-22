@extends('admin.layouts.main')


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
        @foreach ($posts as $post)
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card">
                <div id="carouselExampleDark{{ $post->id }}" class="carousel carousel-dark slide" data-bs-ride="carousel">

                    <div class="carousel-inner">
                        @foreach ($post->images as $image)
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="{{ asset($image->thumbnail_image) }}" class="d-block img-thumbnail w-100" alt="..." height="200">
                        </div>
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark{{ $post->id }}"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Предыдущий</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark{{ $post->id }}"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Следующий</span>
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="text-bold card-title">{{ $post->title }}</h5>
                    <div class="card-text">
                        {{ $post->excerpt }}
                    </div>
                    <div class="row mt-2">
                        <a href="{{ route('admin.posts.show', $post->id) }}" class="col-12 btn btn-outline-primary mb-1">Открыть</a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="col-12 btn btn-success">Изменить</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

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
