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

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                    <form action="{{route('admin.posts.store')}}" method="post" >
                        @csrf
                        <div class="form-group w-50">
                            <input type="text" class="form-control " name="title" placeholder="Название" value="{{old('title')}}">
                            @error('title')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <input type="text" class="form-control " name="user_id" placeholder="Имя" value="{{old('user_id')}}">
                            <div class="text-danger">{{$message}}</div>
                        </div>
                        <div class="form-group">
                            <textarea id="summernote" name="body"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </form>
                    </div>


                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>


@endsection
