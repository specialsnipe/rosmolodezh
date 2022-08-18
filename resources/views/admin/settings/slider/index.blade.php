@extends('admin.layouts.main')

@section('content')



<div class="content-wrapper" style="padding-top: 1rem">
    <!-- Content Header (Page header) -->
    <div class="row d-flex justify-content-between mr-3 ml-3">
        <div class="col-sm-6">
            <h1 class="">Слайдер на главной странице</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                <li class="breadcrumb-item active">Слайдеры на главной странице</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->



    <div class="row m-3">

        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
            <a href="{{route('admin.settings.slider.create')}}" class="btn btn-block btn-primary">Добавить слайдер</a>
        </div>
    </div>
</div>
@endsection

