@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Управление страницей "О нашем проекте"</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item">Управление страницей "О нашем проекте"</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row m-3">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <div>
                            <h2>{{ $about->company_name }} </h2>
                            {{ $about->company_desc }}
                        </div>
                        <a href="{{ route('admin.settings.about.edit', $about->id) }}" class="btn btn-success">Изменить</a>
                    </div>
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            @foreach ($partnership->partnershipItems as $item)--}}
{{--                                <div class="col-6">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h4>{{ $item->title }}</h4>--}}
{{--                                            <div>--}}
{{--                                                <a href="{{ route('admin.settings.partnership.item.edit', [$partnership->id, $item->id]) }}" class="btn btn-success">Изменить</a>--}}
{{--                                                <form action="{{ route('admin.settings.partnership.item.destroy', [$partnership->id, $item->id]) }}" class="d-inline" method="post">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('delete')--}}
{{--                                                    <button class="btn btn-danger">Удалить</button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            {{ $item->body }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <a href="{{route('admin.settings.partnership.item.create',$partnership->id )}}"--}}
{{--                            class="btn btn-block btn-primary">Добавить новую статью </a>--}}
{{--                    </div>--}}
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

@endsection
