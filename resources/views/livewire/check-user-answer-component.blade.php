<div class="card">
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
    </style>
    <div class="card-body">
        <h3>Студенты направления:</h3>
        <div class="line mt-3 mb-3"></div>

        <div class="row">
            @foreach ($students as $student)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="rounded border
                    @if($student->getAnswer($exercise) != null)
                        border-{{ $student->getAnswer($exercise)->class_name }}
                    @endif"
                    >
                    <div class="card-body" style="font-size: .8rem">

                        <a target="_blank" href="{{ route('profile.user.show', $student->id) }}">{{
                            $student->first_and_last_names }}</a>
                        @if($student->getAnswer($exercise) != null)

                        @if($student->getAnswer($exercise)->mark !== null )
                        <span class="mt-1 badge bg-{{ $student->getAnswer($exercise)->class_name }}"
                            style="font-size: .8rem">
                            Оценка: {{ $student->getAnswer($exercise)->mark }}
                        </span>
                        @else
                        <span class="mt-1 badge bg-light" style="font-size: .8rem">
                            Не оценено
                        </span>
                        @endif
                        <button type="button" class="btn btn-primary mt-2 " style="font-size: .8rem"
                            wire:click="openAnswerModal({{ $student->getAnswer($exercise)->id }})">Посмотреть
                            ответ</button>
                        @else
                        <div class="fs-6 text-center w-100 mt-2 ">Ответа нет</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @if (session()->has('message'))
        <div class="modal_bg" wire:click="closeInfoModal"></div>
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('message') }}
        </div>
        <div class="btn btn-danger close-answer-modal" wire:click="closeInfoModal">
            <i class="fa fa-times"></i>
        </div>
    @endif
    @if($modalOpened)
        <div class="modal_bg" wire:click="closeModal"></div>

        <div class="answer-modal card">
            <div class="card-body p-4">
                <h3>Ответ пользователя <a target="_blank" href="{{ route('profile.user.show', $answerUser->id) }}"> {{ $answerUser->firstAndLastNames }} </a>
                </h3>
                <div class="card-text">
                    <span class="fs-4"> Текст ответа: </span>
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            {!! $answerBody !!}
                        </div>
                    </div>
                    <span class="fs-4"> Файлы прикреплённые к ответу: </span>
                    <div class="card mt-3">
                        <div class="card-body">
                            @forelse ($answerFiles as $file)
                            <div>
                                <a href="{{asset($file->file_original_path)}}" download="{{$file->original_file_name}}">
                                    <button class="btn btn-secondary"><i class="fa fa-download"></i>
                                        {{$file->original_file_name}} ({{ round($file->file_size, 2) }} КБ.)</button>
                                </a>
                            </div>
                            @empty
                            <div>Файлы не были приложены</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="fs-3">Оцените решение задания</p>
                        <div class="row">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="col">
                                    <button class="w-100 btn
                                        @if ($i === 1)
                                            btn-dark
                                        @elseif ($i === 2)
                                            btn-danger
                                        @elseif ($i === 3)
                                            btn-warning
                                        @elseif ($i >= 4)
                                            btn-success
                                        @endif
                                        " wire:click="rateAnswer({{ $i }})">
                                        @for($s = 1; $s<=$i; $s++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </button>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        @if(isset($answer->user->tg_id))
                        <p class="fs-3">Если ответ не полный, вы можете позвонить студенту или отправить сообщение через нашего телеграм бота:</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Сообщение которое будет отправлено:</h5>
                                        <p>В начале сообщения будет вот это:</p>
                                        <p>{!! $requiredToMessage !!}</p>
                                        <textarea class="form-control" wire:model='messageToStudent'>

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary  mt-2" wire:click="sendToTgAboutError">
                                    Отправить сообщение
                                </button>
                            </div>
                            <div class="col-12">

                                <p class="text-muted mt-2" style="font-size: 12px"> *Сообщение может быть не отправлено если пользователь не подтвердил свой телеграм,
                                    чтобы узнать подтверил ли он это, зайдите на его личную страницу (нажав на его имя) и в поле "Telegram Username" должна быть галочка</p>
                            </div>
                        </div>
                        @else
                        <span class="fs-3">Если ответ не полный, вы можете ему позвонить.</span>
                        <p> {{ $answer->user->phone }}</p>
                        <p class="text-danger mt-0" style="font-size: 0.8rem">*Пользователь не подтвердил свой телеграм аккаунт, по этому ему нельзя отправить сообщение</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="btn btn-danger close-answer-modal" wire:click="closeModal">
            <i class="fa fa-times"></i>
        </div>
    @endif
</div>
