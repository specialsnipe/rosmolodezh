@extends('admin.layouts.main')

@push('style')
<link rel="stylesheet" href="{{ asset('css/track_styles.css') }}">
@endpush

@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h1 class="m-0">Направление "{{ $track->title }}"</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.tracks.index') }}">Направления</a>
                        </li>
                        <li class="breadcrumb-item active">Направление "{{ $track->title }}"</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if(session()->has('error'))
    <div class="m-3 alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('error') }}
    </div>
    @endif
    {{-- Track info --}}
    <div class="row m-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class=" row align-items-center">

                        <h1 class="col-sm-12 col-lg-8">Направление "{{ $track->title }}"</h1>
                        <div class="col-sm-12 col-lg-4 d-flex justify-content-md-end">
                            <a class="btn btn-info mr-2" href="{{ route('admin.tracks.edit', $track->id) }}">Изменить <i
                                    class="fa fa-pen"></i></a>

                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteTrack">Удалить
                            </button>


                        </div>
                        <x-modal name="Вы уверены что хотите удалить этот трек?" type="delete"
                            action="{{ route('admin.tracks.destroy', [$track->id]) }}" targetid="deleteTrack">
                        </x-modal>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="track_image col-sm-12 col-md-6">
                            <img src="{{ asset($track->image_original) }}" alt="дизайн" height="150">
                        </div>
                        <table class="tack_text track_table">
                            <tr>
                                <td>Куратор направления:</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $track->curator_id) }}">{{
                                        $track->curator->all_names }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Количество блоков:</td>
                                <td>{{ $track->blocks_count }} {{$track->name_blocks_count}}</td>
                            </tr>
                            <tr>
                                <td>Всего обучающихся:</td>
                                <td>{{ $track->users_count }} {{$track->name_users_count}}</td>
                            </tr>
                            <tr>
                                <td>Успеваемость:</td>
                                <td><span class="status_block status_success">100%</span></td>
                            </tr>
                            <tr>
                                <td>Средний балл:</td>
                                <td><span class="status_block status_success">4.7</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- All blokc that track --}}
    <div class="row m-3">
        <div class="col-sm-12 col-md-6 mt-3 mb-3">
            <a href="{{ route('admin.tracks.blocks.create', $track->id)}}" class=" btn btn-block btn-primary">Добавить
                новый блок</a>
        </div>
    </div>

    <div class="row m-3">
        <div class="col-12">
            @forelse($blocks as $block)
            <div class="card" id="{{'accordion'. $block->id }}" role="tablist" aria-multiselectable="true">
                <div class="card-header row align-items-center" role="tab"
                    style="padding:20px; display: flex; justify-content: space-between">

                    <h5 class="mb-0 col-sm-12 col-lg-8 header-of-card ">
                        <span data-toggle="collapse" data-parent="{{'#accordion'. $block->id }}" aria-expanded="true"
                            aria-controls="collapseOne">
                            {{ $loop->index + 1 }} | Блок - "{{ $block->title }}" (id:{{$block->id}})
                        </span>
                    </h5>
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-md-end">
                        <a class="btn btn-outline-secondary  mr-2"
                            href="{{ route('admin.tracks.blocks.show', [$track->id, $block->id]) }}"> <i
                                class="fa fa-eye"></i> Открыть</a>
                        <a class="btn btn-info mr-2"
                            href="{{ route('admin.tracks.blocks.edit', [$track->id, $block->id]) }}">Изменить <i
                                class="fa fa-pen"></i></a>

                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#modalBlock">Удалить</button>

                        <x-modal name="Вы уверены что хотите удалить этот блок?" type="delete"
                            action="{{ route('admin.tracks.blocks.destroy', [$track->id, $block->id]) }}"
                            targetid="modalBlock">
                        </x-modal>
                    </div>
                </div>

                <div class="card-body table-responsive collapse" role="tabpanel" aria-labelledby="headingOne">
                    <a
                                href="{{  route('admin.blocks.exercises.create', $block->id) }}"
                                class="btn btn-success mb-3"> Добавить задание </a>
                    <table class="table table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr class="col sm-12">
                                <th style="width: 70px">id</th>
                                <th>Название задания</th>
                                <th style="width: 170px">Создатель</th>
                                <th style="width: 170px">Дата создания</th>
                                <th>Статистика</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($block->exercises as $exercise)
                            <tr>
                                <td>{{ $exercise->id }}</td>
                                <td><a href="{{route('admin.blocks.exercises.show', [$block->id, $exercise->id])}}">{{ $exercise->title }}</a></td>
                                <td>{{ $exercise->creator->first_and_last_names }}</td>
                                <td>{{ $exercise->created_at }}</td>
                                <td>
                                    <table class="table-head-fixed text-nowrap">
                                        <tr>
                                            <td>Время на выполнение:</td>
                                            <td>
                                                {{$exercise->time}} {{$exercise->name_minute_count}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{route('admin.exercises.answers.index', $exercise->id)}}">Сдано работ:</a></td>
                                            <td>10/{{ $track->users_count }}</td>
                                        </tr>
                                        <tr>
                                            <td>Успеваемость:</td>
                                            <td><span class="status_block status_success">100%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Средний балл:</td>
                                            <td><span class="status_block status_success">4.1</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            @if($loop->last)
                            <tr>
                                <td colspan="5">
                                    <a href="{{  route('admin.blocks.exercises.create', $block->id) }}"
                                        class="btn btn-success mb-3"> Добавить ещё одно задание </a> </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="5">

                                    <p>В данном блоке пока что нет заданий :( </p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
            @empty

            @endforelse


        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
            $(".header-of-card").each(function () {
                $(this).click(function () {
                    $(this).parent().parent().children('.collapse').slideToggle("fast");
                })
            });
        });
</script>
@endpush
