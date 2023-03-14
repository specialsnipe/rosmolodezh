@extends('admin.layouts.main')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <style>
        .btn-outline-secondary {
            background: none !important;
            color: #515151 !important;
            border: 1px solid #ababab !important;
        }
        .btn-outline-secondary:hover {
            background: none !important;
            color: #515151 !important;
            border: 1px solid #515151 !important;
        }
        .btn-outline-secondary.active {
            background: inherit;
        }
        .outline-sended-answer {
            border: 1px solid var(--main-success) !important;
            background: var(--main-success-bg) !important;
        }
        .outline-sended-answer-block {
            border: 1px solid var(--main-success) !important;
            background: var(--main-success-bg) !important;
            background: inherit;
        }
    </style>

@endpush

@section('content')
    <style>
        table tr td:nth-child(2) {
            word-break: break-all;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-sm-6">
                        <h1 class="ml-3">{{$user->login}} @if(auth()->user()->id == $user->id)
                                <span class="text-muted">(Это вы)</span>
                            @endif
                            @if(isset($isCurator))
                                <span class="text-success">
                                    Является куратором направления {{ $isCurator->title }}
                                </span>
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Пользователи</a></li>
                            <li class="breadcrumb-item active">{{$user->login}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content m-3">
            <div class="card ">
                <div class="card-body row ">
                    <div class="col-sm-12 col-md-4">
                        <img class="card-img-top" src="{{ asset($user->avatar_medium_path) }}"
                             alt="Аватарка пользователя">
                    </div>
                    <table class=" table table-head-fixed text-wrap col-sm-12 col-md-8 ">
                        <tbody>
                        <tr>
                            <th class="col-sm-4 col-md-2">Статус:</th>
                            <td class="col-sm-8  col-md-10"> @if(isset($user->deleted_at))
                                    <span class="badge badge-danger">Удалён</span>
                                @else
                                    <span class="badge badge-success">Активен</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="col-sm-4 col-md-2">ID</th>
                            <td class="col-sm-8  col-md-10">{{$user->id}}</td>
                        </tr>
                        <tr>
                            <th>Логин</th>
                            <td>{{$user->login}}</td>
                        </tr>
                        <tr>
                            <th>ФИО</th>
                            <td>{{$user->last_name}} {{$user->first_name}} {{$user->father_name}} </td>
                        </tr>
                        <tr>
                            <th>Выбранное направление</th><td>
                            @if($user->tracks)
                                @forelse($user->tracks as $track)
                                    <div class="h4 d-inline">
                                    <span class=" badge bg-primary">{{$track->title}}</span>
                                    </div>
                                        @empty
                                    Направление не выбрано
                                @endforelse
                            @endif
                                </td>
                        </tr>
                        <tr>
                            <th>Контактный номер</th>
                            <td>{!! $user->phone ?? "<span class='text-secondary'>Не указано</span>"!!}</td>
                        </tr>
                        <tr>
                            <th>Возраст</th>
                            <td>@if(isset($user->age))
                                    {{$user->age}}
                                @else
                                    <span class="text-secondary">Возраст не указан</span>
                                @endif </td>
                        </tr>
                        <tr>
                            <th>Пол</th>
                            <td>{!! $user->gender ? $user->gender->name : "<span class='text-secondary'>Не указано</span>" !!}</td>
                        </tr>
                        <tr>
                            <th>Деятельность</th>
                            <td>{!! $user->occupation ? $user->occupation->name : "<span class='text-secondary'>Не указано</span>"!!}</td>
                        </tr>
                        <tr>
                            <th>Роль</th>
                            <td>{{$user->role->name}}</td>
                        </tr>
                        <tr>
                            <th>Почта</th>
                            <td>{{$user->email}}
                                @if(isset($user->email_verified_at))
                                    <span class="text-muted">(почта подтверждена: {{ $user->email_verified_at }})</span>
                                @else
                                    <span class="text-danger"> (почта не подтверждена)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Телеграм</th>
                            <td><a target="_blank" href="{{ $user->tg_url}}"> {{ $user->tg_name }} </a>
                                @if(isset($user->tg_id))
                                    <span class="text-muted">({{ $user->tg_id }})</span>
                                @else
                                    <span class="text-danger"> (пользователь ещё не запустил бота)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Вконтакте</th>
                            <td>{{$user->vk_rul}}</td>
                        </tr>
                        <tr>
                            <th>Комментарий</th>
                            <td>{{$user->about}}</td>
                        </tr>

                        <tr>
                            <th>Место работы куратора</th>
                            @if($isCurator)
                                @if($user->curator_job)
                                    <td>{{$user->curator_job}}</td>
                                @else
                                    <td>не указано</td>
                                @endif
                            @else
                                <td>не является куратором</td>
                            @endif
                        </tr>
                        <tr class="">
                            <th>О кураторе</th>

                            @if($isCurator)
                                @if($user->curator_about)
                                    <td class="text-wrap" >{{$user->curator_about}}</td>
                                @else
                                    <td>не указано</td>
                                @endif
                            @else
                                <td>не является куратором</td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <div class="row">
                            @if(auth()->user()->id != $user->id)
                                <div class="col-sm-6 col-xl-4">
                                    @if (isset($user->deleted_at))

                                        <form action="{{route('admin.users.changeStatus', $user->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-success col-12 ">Восстановить <i
                                                    class="fa-solid fa-rotate-left"></i></button>
                                        </form>
                                    @else
                                        <form action="{{route('admin.users.destroy',$user->id)}}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger col-12 ">Деактивировать <i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    @endif

                                </div>
                            @endif

                            <div class="col-sm-6 col-xl-4">
                                <a class="btn btn-light col-12" href="{{ route('admin.users.edit', $user->id) }}">
                                    Изменить <i class="fa fa-pen"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if($isStudent)
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-3">Ответы ученика</h1>
                            @forelse($tracks as $track)
                                <div class="card track_item mb-3 w">
                                    <div class="card-body">
                                        <div class="row"><h4 class="mb-0">{{ $track->title }}</h4></div>
                                        <hr>

                                        <div class="row"><h5 class="mb-3">Блоки:</h5></div>
                                        <div class="row">
                                            @foreach($track->blocks as $block)
                                                <div class="col-sm-12 col-md-6 col-lg-3

                                    ">
                                                    <div
                                                        class="btn btn-outline-secondary w-100  h-100 d-flex justify-content-center align-items-center show-exercises
                                                @if($block->hasAnswers) btn-outline-success outline-sended-answer-block @endif
                                            "
                                                        data-track-id="{{$track->id}}"
                                                        data-block-id="{{$block->id}}"
                                                        data-block-name="{{$block->title}}"
                                                    >
                                                        {{$block->title}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row exercises exercises-track-{{$track->id}} d-none">

                                            <div class="col-12">
                                                <h5 class="mb-3 mt-3">
                                                    Упражнения блока
                                                    "<span class="track-{{$track->id}}-block-name" id="block-name">::выбранный блок::</span>":
                                                </h5>
                                            </div>
                                            @foreach($track->blocks as $block)
                                                <div class="col-12 track-{{$track->id}}-block-item d-none" id="{{$track->id}}-{{ $block->id }}">
                                                    <div class="row">
                                                        @foreach($block->exercises as $exercise)
                                                            <div class="col-sm-12 col-md-6 col-lg-3 mb-2 ">
                                                                <div
                                                                    class="btn btn-outline-secondary w-100 exercise h-100 d-flex justify-content-center align-items-center
                                                                    @if($exercise->answers->count()) btn-outline-success outline-sended-answer exercise-with-answer @endif"
                                                                    data-block-id="{{$block->id}}"
                                                                    data-exercise-id="{{$exercise->id}}"
                                                                >
                                                                    {{$exercise->title}}
                                                                    @if($exercise->answers->count())
                                                                        <div class="custom-checkbox mr-2" style="pointer-events: none" >
                                                                            <i class="fa fa-check"></i>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                @if($block->hasAnswers)
                                                                    <x-modal-answer
                                                                        :exercise="$exercise"
                                                                        :answers="$exercise->answers"
                                                                    />
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="row">

                                        </div>
                                    </div>
                                </div>
                            @empty
                                Нет направлений
                            @endforelse
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-6 col-xl-4 mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-primary col-12"> Назад</a>
                </div>
            </div>

        </section>
    </div>
    </div>

@endsection

@push('script')
    <script defer>
        window.onload = () => {
            $('.show-exercises').click((ev) => {
                const trackId = ev.target.dataset.trackId;
                const blockId = ev.target.dataset.blockId;
                document.querySelector(`.track-${trackId}-block-name`).innerText = ev.target.dataset.blockName;
                const parent = document.querySelector(`.exercises-track-${trackId}`);
                parent.classList.remove('d-none');
                const items = parent.querySelectorAll(`.track-${trackId}-block-item`);
                console.log(items);
                items.forEach((item) => {
                    item.classList.add('d-none')
                    if (item.id === `${trackId}-${blockId}`) {
                        item.classList.remove('d-none')
                    }
                })
            })

            $('.exercise-with-answer').click((ev) => {
                const exerciseId = ev.target.dataset.exerciseId;
                document.querySelector(`.exercise-${exerciseId}-answer`)?.classList.remove('d-none')
            })

            $('.modal_bg').click((ev) => {
                const exerciseId = ev.target.dataset.exerciseId;
                document.querySelector(`.exercise-${exerciseId}-answer`)?.classList.add('d-none')
            })
        }

    </script>
@endpush
