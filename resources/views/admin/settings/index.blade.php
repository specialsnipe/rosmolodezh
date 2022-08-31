@extends('admin.layouts.main')


@section('content')
<div class="content-wrapper" style="padding-top: 1rem">
    <!-- Content Header (Page header) -->

    <div class="row d-flex justify-content-between mr-3 ml-3">
        <div class="col-sm-3">
            <h1 class="">Настройки проекта</h1>
        </div><!-- /.col -->
        <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                <li class="breadcrumb-item active">Настройки проекта</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row m-3">


        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <a class="card-body" href="{{route('admin.settings.complexity.index')}}">
                    <span  class="h5"><i class="fa fa-th-list" aria-hidden="true"></i> Сложность и время на выполнение заданий </span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <a class="card-body" href="{{route('admin.settings.slider.index')}}">
                    <span  class="h5" ><i class="fa fa-desktop" aria-hidden="true"></i> Слайдер на главной странице </span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <a class="card-body" href="{{route('admin.settings.information.index')}}">
                    <span  class="h5" ><i class="fa fa-info-circle" aria-hidden="true"></i>  Настройки данных организации </span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card ">
                <a class="card-body" href="{{route('admin.settings.roles.index')}}">
                    <span class="h5" ><i class="fa fa-user-secret"></i> Роли</span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <a class="card-body" href="{{route('admin.settings.occupations.index')}}">
                    <span class="h5" ><i class="fa fa-briefcase"></i> Занятость</span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <a class="card-body" href="{{route('admin.settings.genders.index')}}">
                    <span  class="h5"> <i class="fa fa-venus-mars"></i> Пол</span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <a class="card-body" href="{{route('admin.settings.phrases.index')}}">
                    <span  class="h5"> <i class="nav-icon fas fa-trophy"></i> Фразы</span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <a class="card-body" href="{{route('admin.settings.team.index')}}">
                    <span  class="h5"> <i class="nav-icon fa fa-users"></i> Команда</span>
                </a>
            </div>
        </div>
        {{-- <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <a  class="h5" href="{{route('admin..index')}}"><i class="fa fa-clock"></i>  </a>
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection
