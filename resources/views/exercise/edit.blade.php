@extends('layouts.main')
@push('style')
    @livewireScripts
    <link rel="stylesheet" href="{{  asset('css/exercise-styles.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0">Изменение задания: {{$exercise->title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.index')}}">Направления</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.show', $block->track->id)}}">{{  $block->track->title }}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.blocks.show', [$block->track->id, $block->id])}}">{{  $block->title }}</a></li>
                            <li class="breadcrumb-item active">Добавление нового задания</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    @livewire('exercise-edit-component', ['block' => $block, 'exercise'=> $exercise])
    </div>
@endsection
@push('script')

    @livewireScripts
@endpush
