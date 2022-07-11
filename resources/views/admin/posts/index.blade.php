@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Новости</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Новости</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Fixed Header Table</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Поиск">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Автор</th>
                                <th>Текст</th>
                                <th>Картинки</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td><a href="{{route('admin.posts.show',$post->id)}}">{{$post->title}}</a></td>
                                <td>{{$post->user->login}}</td>
                                <td>{!!$post->body!!}</td>
                                <td>@foreach($post->images as $image)
                                        <img src="{{ $image->url }}" alt="" width="100px">
                                    @endforeach</td>
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
                <div class="col-2 mt-3">
                    <a href="{{route('admin.posts.create')}}"
                       class="btn btn-block btn-primary">Добавить новость</a>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

@endsection
