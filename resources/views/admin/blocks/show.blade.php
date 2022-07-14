@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Блок: {{$block->title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">{{$track->title}}</li>
                            <li class="breadcrumb-item active">{{$block->title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="row">
                <div class="col-12 m-3">
                    <div class="card w-75">
                        <div class="card-body">
                            <div class="row tack_info">
                                <div class="col -6 track_image">
                                    <img src="{{ asset($block->image_original) }}" alt="дизайн" height="150px">
                                </div>
                                <table class="col-6 tack_text track_table">
                                    <tr>
                                        <td>Куратор направления:</td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $track->curator_id) }}">{{ $track->curator->all_names }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Количество упражнений:</td>
                                        <td>{{ $block->exercises_count }} упражнений</td>
                                    </tr>
                                    <tr>
                                        <td>Всего обучающихся:</td>
                                        <td>{{ $track->users_count }} человек</td>
                                    </tr>
                                    <tr>
                                        <td>Успеваемость:</td>
                                        <td><span class="status_block status_success">100%</span></td>
                                    </tr>
                                    <tr>
                                        <td>Средний балл:</td>
                                        <td><span class="status_block status_success">4.7</span></td>
                                    </tr>
                                    <tr>
                                        <td>Дата начала блока:</td>
                                        <td><span
                                                class="status_block status_success">{{$block->date_start->format('d.m.Y')}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Дата окончания блока:</td>
                                        <td><span
                                                class="status_block status_success">{{$block->date_end->format('d.m.Y')}}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <section class="content">
                                <div class="row">
                                    <div class="col-1 mt-3 mr-3">
                                        <a href="{{route('admin.tracks.blocks.edit',[$track->id, $block->id])}}"
                                           class="btn btn-warning ">Изменить</a>
                                    </div>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" >Удалить</button>

                                    <x-modal name="Вы уверены что хотите удалить?" type="delete" action="{{ route('admin.tracks.blocks.destroy', [$block->track->id,$block->id]) }}">

                                    </x-modal>
                                    @error('modal_password')
                                        <x-modal show="true" name="Ошибка" type="error">
                                            <x-slot name="info">{{$message}}</x-slot>
                                        </x-modal>
                                    @enderror
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

                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-4 mt-3 mb-3">
                        <a href="{{ route('admin.blocks.exercises.create', $block->id)}}"
                           class="btn btn-block btn-primary">Добавить новое упражнение</a>
                    </div>
                    <div class="card-body table-responsive p-3">
                        <ul class="list-group">
                       @forelse($block->exercises as $exercise)
                            <li class="list-group-item">
                                <div class="row my-2">
                                    <div class="col-1 text-center">
                                        <div class="h3 fw-light">1</div>
                                       <div class="h3 fw-light">{{ $loop->index + 1 }}</div>
                                    </div>
                                    <div class="col">
                                        <h3 class="h5">
                                            <a class="text-decoration-none link-dark me-2"
                                               href="/courses/layout-designer-basics/lessons/intro/theory_unit">{{ $block->title }}</a>
                                        </h3>
                                        <div class="mt-3 text-muted">{!! $block->body !!}
                                        </div>
                                    </div>
                                    <div class="w-100 d-lg-none"></div>
                                    <div class="col-1 d-lg-none"></div>
                                    <div
                                        class="col col-lg-auto d-flex flex-lg-column flex-wrap flex-lg-nowrap align-items-lg-end justify-content-lg-center mt-2 mt-lg-0">
                                        <div class="small me-2 me-lg-0">
                                            <span aria-hidden="true" class="far fa-check text-success"></span>
                                            <span class="sr-only">Теория пройдена</span>
                                            <a class="text-decoration-none link-success"
                                               href="/courses/layout-designer-basics/lessons/intro/theory_unit">теория</a>
                                        </div>

                                    </div>
                                </div>
                            </li>
                       @empty

                       @endforelse
                        </ul>
                    </div>
                </div>
            </div>



        </div>

    </div>

@endsection
