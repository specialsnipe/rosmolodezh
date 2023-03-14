@extends('layouts.main')

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
    <style>
        .modal_bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background: hsl(0 0% 0%/0.2)
        }

        .answer-modal {
            top: 50%;
            left: 50%;
            width: 50%;
            transform: translate(-50%, -50%);
            position: fixed;
            background: white;
            z-index: 1001;
            max-height: 90%;
            overflow-y: auto;
        }

        .close-answer-modal {
            position: fixed;
            right: 20px;
            top: 20px;
            z-index: 1002;

        }
        .alert {
            position: fixed;
            z-index: 1002;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        }
        .close-answer-modal.btn-danger{
            padding: 5px 11px;
        }
        .btn.btn-success{
            padding: .7rem 0;
        }
        @media (min-width:280px) and (max-width: 767px) {
            .answer-modal{
                width: 90%;
            }
            .close-answer-modal{
                top: 55px;
                right: 32px;

            }
            h3{
                margin-top: 2rem;
            }
            button.btn{
                margin-top: 1rem;
            }
            .fs-3{
                margin-bottom: 0;
            }
            .btn.btn-primary{
                width: 100%;
            }

        }
    </style>
@endpush

@section('content')


<div class="container p-0">
    @if(session()->has('message'))
        <div class="container p-0">

            <div class="alert alert-success alert-dismissible fade show w-100 m-0 mt-4" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        </div>
    @endif
    <div class="main-container-directions">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-3 d-flex flex-column upload-image">
                <img src="{{ asset($user->avatar_original_path) }}" class="img-fluid rounded mb-2 img-bordered"
                     style="object-fit: contain"
                    alt="">
            </div>

            <div class="form-content mb-4 col-xs-12 col-md-12 col-lg-9">
                <a href="{{ url()->previous() }}" class="btn btn-secondary d-block d-lg-none d-md-none d-sm-block mb-5"> Назад ></a>
                <div class="text-header mb-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex justify-content-center">
                        <span>Личные данные "{{ $user->firstAndLastNames }}"</span>
                        @if($isDeleted)
                            <div class="d-flex align-items-center">
                                <span class="badge bg-black fs-6 d-block">удален</span>
                            </div>
                        @endif
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary d-none d-lg-block d-md-block d-sm-none"> Назад ></a>
                </div>

                <div class="form-group row">
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control " >{{ $user->last_name ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Фамилия</label>

                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control">{{ $user->first_name ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Имя</label>

                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span readoly name="father_name" type="text"
                            class="form-control " id="floatingPassword"
                            placeholder="Отчество" value="{{ $user->father_name ?? 'Не задано' }}"> </span>
                        <label for="floatinginput readoly">Отчество</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control" >{{ $user->login ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Логин</label>

                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control">{{ $user->phone ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Номер телефона</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control ">{{ $user->age ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">возраст</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4" style="display: flex; ">
                        <span style="width: 40px; display:flex; justify-content: center; align-items: center; background-color:#4886FF;
                    border-radius: 5px 0 0 5px ; color: white;">@</span>
                        <span readoly name="tg_name" style="border-radius: 0 5px 5px 0;" type="text" id="telegram"
                            class="form-control " placeholder="Telegram Username"
                            aria-label="Username" aria-describedby="basic-addon1" value="">{{ $user->tg_name ?? 'Не задано' }}</span>
                        <label for="floatingPassword" style="margin-left:40px;">Telegram Username</label>
                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control">{{ $user->email ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">E-mail</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control"> <a href="{{ $user->vk_url ?? '#' }}">{{ $user->vk_url ?? 'Не задано' }}</a> </span>
                        <label for="floatinginput readoly">Ссылка на ВКонтакте</label>
                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
                        <span class="form-control ">{{ $user->gender ? $user->gender->name : 'Не задано' }}</span>
                        <label for="floatinginput readoly">Пол</label>
                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
                        <span class="form-control ">{{ $user->occupation->name }}</span>
                        <label for="floatinginput readoly">Занятость</label>
                    </div>

                </div>
            </div>
        </div>
        <hr class="line">
        <h1 class="mb-3">Ответы ученика</h1>
        <div class="row">
            @forelse($tracks as $track)
                <div class="card track_item mb-3">
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
                                            @if($block->hasAnswers) outline-sended-answer-block @endif
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
                                            @if($exercise->answers->count()) outline-sended-answer exercise-with-answer @endif"
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
@endsection
@push('script')
    <script defer>
        window.onload = () => {
            $('button.img-btn').on('click', function (event) {
                $('input readoly.img-btn').click()
            })
            $('input readoly.img-btn').on('input readoly', function (event) {
                $('.upload-image').trigger( "submit" );
            })
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
