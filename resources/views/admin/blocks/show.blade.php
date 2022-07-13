@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$block->title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">{{$block->title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{$block->id}}</td>
                            </tr>
                            <tr>
                                <td>Название</td>
                                <td>{{$block->title}}</td>
                            </tr>
                            <tr>
                                <td>Текст блока</td>
                                <td>{!!$block->body!!}</td>
                            </tr>
                            <tr>
                                <td>Иконка</td>
                                <td style="display: flex; flex-direction: column">
                                    <img src="{{asset($block->image_thumbnail) }}" alt="" width="100px">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row">
                    <div class="col-1 mt-3">
                        <a href="{{route('admin.tracks.blocks.edit',[$track->id, $block->id])}}"
                           class="btn btn-warning ">Изменить</a>
                    </div>
                    <div class="col-1 mt-3">
                        <form action="{{route('admin.tracks.blocks.destroy',[$track->id, $block->id])}}"
                              method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger " value="Удалить">
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
