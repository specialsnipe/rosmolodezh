@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ответы учеников</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.index')}}">Направление</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.tracks.show', $track->id) }}">{{$track->title}}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.tracks.blocks.show',[$track->id, $block->id] )}}">{{$block->title}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                >{{$exercise->title}}</a></li>
                            <li class="breadcrumb-item active">Ответы учеников</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" row align-items-center">

                            <h1 class="col-sm-12 col-lg-8">Упражнение: "{{ $exercise->title }}"</h1>
                            <div class="col-sm-12 col-lg-4 d-flex justify-content-md-end">

                                {{--                                TODO сделать ссылки для изменения удаления,когда будет реализован функционал--}}

                                <a class="btn btn-info mr-2" href="#">Изменить <i
                                        class="fa fa-pen"></i></a>

                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteTrack">Удалить
                                </button>

                            </div>
                            <x-modal name="Вы уверены что хотите удалить этот трек?" type="delete"
                                     action="#" targetid="deleteTrack">
                            </x-modal>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="block_name ">
                                    <h4>Траектория: "{{$track->title}}"</h4>
                                </div>
                                <div class="block_name  ">
                                <h5>Блок:         "{{$block->title}}"</h5>
                                </div>
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
                                    <td>Всего обучающихся:</td>
                                    <td>{{ $track->users_count }} {{$track->name_users_count}}</td>
                                </tr>
                                <tr>
                                    <td>Ответов:</td>
                                    <td>10/30</td>
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
        <div class="row">

            <div class="card m-3 col-12">
                <div class="card-head p-3">
                    <h3 class="card-title">Ответы учащихся на упражнение {{$exercise->title}}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Аватар</th>
                            <th>ФИО</th>
                            <th>Оценка</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($track->users as $user)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>{{$user->id}}</td>
                                <td><img src="{{asset($user->avatar_thumbnail_path)}}" width=50px height=50px
                                         alt="image">
                                </td>
                                <td>
                                    <span>
                                                {{$user->last_name}}
                                            </span>
                                    <span>
                                                {{$user->first_name}}
                                            </span>
                                    <span>
                                                {{$user->father_name}}
                                            </span>

                                </td>

                                <td>
                                    <span
                                        style="padding: 5px 10px; background: #72c07d; border-radius: 5px">@if(!$exercise->number) работа не сдана  @endif </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td>Учащихся нет</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- * Filter block --}}

            {{-- @livewire('users-component') --}}

            {{--            <div class="card m-3 p-3">--}}
            {{--                {{ $exercise->users->withQueryString()->links() }}--}}
            {{--            </div>--}}
        </div>
    </div>
    </div>
@endsection

