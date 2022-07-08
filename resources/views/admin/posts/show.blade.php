@extends('admin.layouts.main')


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
                            <li class="breadcrumb-item active">{{$post->title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card-body table-responsive p-0 w-50">
                <table class="table table-hover text-nowrap">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{$post->id}}</td>
                    </tr>
                    <tr>
                        <td>Название</td>
                        <td>{{$post->title}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-1 mt-3">
                <a href="{{route('admin.posts.edit',$post->id)}}"
                   class="btn btn-warning ">Изменить</a>
            </div>
            <div class="col-1 mt-3">
                <form action="{{route('admin.posts.destroy',$post->id)}}"
                      method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger " value="Удалить">
                </form>
            </div>
        </div>
    </section>



@endsection
