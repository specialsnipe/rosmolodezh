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
        {{-- <div class="col-12"> --}}
            {{-- <div class="card">
                <div class="card-header">
                    <h4>Все новости</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;"> --}}
                    {{-- <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 30px">ID</th>
                                <th style="width: 220px">Название</th>
                                <th style="width: 180px">Автор</th>
                                <th style="width: 380px">Текст</th>
                                <th>Картинки</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td><a href="{{route('admin.posts.show',$post->id)}}">{{$post->title}}</a></td>
                                <td>{{$post->user->login}}</td>
                                <td>
                                    <span style="">{!! Str::limit($post->excerpt, 20, '...') !!} </span>
                                </td>
                                <td>
                                    <div class="image_container">
                                        @foreach($post->images as $image)
                                        <img src="{{ asset($image->thumbnail_image) }}" alt="" width="100px">
                                        @endforeach
                                    </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td></td>
                                <td>Постов нет</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table> --}}
                    {{-- </div> --}}
                <!-- /.card-body -->
                {{--
            </div> --}}
            <!-- /.card -->

            {{--
        </div> --}}

        @foreach ($posts as $post)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2">
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
                    {{ $post->excerpt }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
