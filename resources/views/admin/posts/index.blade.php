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
                <a href="{{route('admin.posts.create')}}"
                   class="btn btn-block btn-primary">Добавить новость</a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Все новости</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
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
                                    <span style="">{!!   Str::limit($post->excerpt, 20, '...') !!}  </span>
                                </td>
                                <td>
                                    <div class="image_container">
                                    @foreach($post->images as $image)
                                        <img src="{{ asset($image->thumbnail_image) }}" alt="" width="100px">
                                    @endforeach</div>

                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Постов нет</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

@endsection
