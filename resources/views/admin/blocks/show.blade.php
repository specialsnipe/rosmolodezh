@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="ml-3">Блок: {{ $block->title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tracks.index') }}">Направления</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.tracks.show', $track->id) }}">{{ $track->title }}</a></li>
                            <li class="breadcrumb-item active">{{ $block->title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            {{-- Block info --}}
            @if(session()->has('error'))
                <div class="m-3 alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12 m-3">
                    <div class="card ">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-6 track_image">
                                    <img class="img-fluid rounded mb-2" src="{{ asset($block->image_medium) }}" alt="дизайн" height="150px">
                                </div>
                                <table class="col-6 tack_text track_table">
                                    <tr>
                                        <td>Куратор направления:</td>
                                        <td>
                                            <a
                                                href="{{ route('admin.users.show', $track->curator_id) }}">{{ $track->curator->all_names }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Количество упражнений:</td>
                                        <td>{{ $block->exercises_count }} {{ $block->name_exercises_count }}</td>
                                    </tr>
                                    <tr>
                                        <td>Всего обучающихся:</td>
                                        <td>{{ $track->users_count }} {{ $track->name_users_count }}</td>
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
                                                class="status_block status_success">{{ $block->date_start->format('d.m.Y') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Дата окончания блока:</td>
                                        <td><span
                                                class="status_block status_success">{{ $block->date_end->format('d.m.Y') }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-mb-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 row">
                                            <a href="{{ route('admin.tracks.blocks.edit', [$track->id, $block->id]) }}"
                                                class="col-12 btn btn-warning ">Изменить</a>
                                        </div>
                                        <div class="col-sm-12 col-md-6 row">
                                            <button type="button" class="col-12 btn btn-danger" data-toggle="modal"
                                                    data-target="#modalBlock">Удалить
                                            </button>

                                            <x-modal name="Вы уверены что хотите удалить этот блок?" type="delete"
                                                action="{{ route('admin.tracks.blocks.destroy', [$track->id, $block->id]) }}"
                                                targetid="modalBlock">
                                            </x-modal>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    {{-- Add new blokc button --}}
                    <div class="col-sm-12 col-md-6 ml-2 mb-3">
                        <a href="{{ route('admin.blocks.exercises.create', [$block->id]) }}"
                           class="btn btn-block btn-primary">Добавить новое упражнение</a>
                    </div>
                    {{-- All exercises of this block --}}
                    <div class="card-body table-responsive p-3">
                        <ul class="list-group">
                            @forelse($block->exercises as $exercise)
                                <li class="list-group-item">
                                    <div class="row my-2">
                                        <div class="col-1 text-center">
                                            <div class="h3 fw-light">{{ $loop->index + 1 }}</div>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <h4 class="col-8">
                                                    <a class="text-decoration-none link-dark me-2"
                                                       href="{{ route('admin.blocks.exercises.show', [$block->id, $exercise->id]) }}">{{ $exercise->title }}</a>
                                                </h4>
                                                <div class="col-sm-12 col-lg-4 d-flex justify-content-md-end">
                                                    <a class="btn btn-info mr-2"
                                                       href="{{ route('admin.tracks.blocks.edit', [$track->id, $block->id]) }}">Изменить <i
                                                            class="fa fa-pen"></i></a>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteExercise">Удалить</button>

                                                    <x-modal name="Вы уверены что хотите удалить это упражнение?" type="delete"
                                                             action="{{ route('admin.blocks.exercises.destroy', [$block->id, $exercise->id]) }}"
                                                             targetid="deleteExercise">
                                                    </x-modal>
                                                </div>
                                            </div>

                                            <div class="">
                                                <span>Уровень освоения: </span>
                                                <h5 style="display: inline"><span
                                                        title="{{ $exercise->complexity->body }}"
                                                        class="badge
                                                            @if ($exercise->complexity_id == 1) badge badge-primary @endif
                                                            @if ($exercise->complexity_id == 3) badge badge-warning @endif
                                                            @if ($exercise->complexity_id == 4) badge badge-danger @endif
                                                            @if ($exercise->complexity_id == 5) badge badge-danger @endif
                                                            @if ($exercise->complexity_id == 2) badge badge-success @endif
                                                            ">
                                                    {{ $exercise->complexity->level }} </h5>
                                                <span> | Время на выполнение:</span>
                                                <h5 style="display: inline">
                                                        <span
                                                            class="
                                                        @if ($exercise->time <= 15) badge badge-primary
                                                        @elseif($exercise->time <= 30) badge badge-success
                                                        @elseif($exercise->time <= 60) badge badge-warning
                                                        @elseif($exercise->time <= 120) badge badge-danger
                                                        @elseif($exercise->time <= 240) badge badge-danger
                                                        @else badge badge-dark @endif
                                                        ">
                                                            {{ $exercise->time }} {{ $exercise->name_minute_count }}
                                                        </span>
                                                </h5>
                                            </div>
                                            <div class="mt-3 text-muted text-truncate">{!! $exercise->excerpt !!}
                                            </div>
                                            <div class="mt-3">
                                                <a class="btn btn-info"
                                                   href="{{route('admin.exercises.answers.index', $exercise->id)}}">Просмотр
                                                    работ</a>
                                            </div>
                                        </div>
                                        <div>

                                        </div>
                                        <div class="w-100 d-lg-none"></div>
                                        <div class="col-1 d-lg-none"></div>
                                        <div
                                            class="col col-lg-auto d-flex flex-lg-column flex-wrap flex-lg-nowrap align-items-lg-end justify-content-lg-center mt-2 mt-lg-0">
                                            <div class="small me-2 me-lg-0">
                                                <span aria-hidden="true" class="far fa-check text-success"></span>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @empty
                                Нет заданий
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
