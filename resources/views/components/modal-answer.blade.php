@props(['exercise','answers',])

@php
$answer = $answers->values()->get(0);
@endphp
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

<div class="exercise-answer-modal exercise-{{ $exercise->id }}-answer d-none" data-exercise-id="{{ $exercise->id }}">
    <div class="modal_bg" data-exercise-id="{{ $exercise->id }}"></div>

    <div class="answer-modal card">
        <div class="card-body p-4">
            <h3> Ответ на упражнение "{{ $exercise->title }}" </h3>
            <div class="card-text">
                <span class="fs-5"> Текст ответа: </span>
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        {!! $answer->body !!}
                    </div>
                </div>
                <span class="fs-5"> Файлы прикреплённые к ответу: </span>
                <div class="card mt-3">
                    <div class="card-body">
                        @forelse ($answer->answerFiles as $file)
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
                @if($answer->mark)
                    <div class="d-flex fs-5 mt-3" style="gap:10px">
                        <div>Оценка за задание: </div>
                        <div class="d-flex align-items-center mr-3">
                            <span class="badge {{ $answer->markColor }} d-block">{{ $answer->mark }}</span>
                        </div>
                    </div>
                @else
                    <span class="fs-5 mt-3">Работа сдана, но не оценена </span>
                @endif

            </div>
        </div>
    </div>

</div>

