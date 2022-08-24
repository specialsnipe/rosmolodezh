@php
$user = auth()->user();
@endphp

@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

<div class="container">


    <div class="main-container-directions">
        {{-- @foreach ($blocks as $block)
        <div class="edit-block ">
            <div class="edit-row">
                <div class="text">
                    <div class="text-h1">{{ $block->title }}</div>
                    <div class="text-h2">{{ $block->body }}</div>

                    <div class="information">
                        <div class="block-start">
                            Начался: <span> {{ $block->date_start }}</span>
                        </div>
                        <div class="block-end">
                            Закончился: <span> {{ $block->date_end }}</span>
                        </div>
                    </div>
                </div>

                <div class="btn-edit">
                    <div class="info-block">
                        <div class="one">
                            <p>Часы(ов):</p>
                            <p class="number-one"> {{ $block->duration }}</p>
                        </div>
                        <div class="one">
                            <p>Твой средний балл:</p>
                            <p class="number-two rating-two"> {{ $block->average_score }}</p>
                        </div>
                        <div class="one">
                            <p>Преподаватель: {{ $block->teacher->short_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <section id="accordion-w">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="collapseOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="d-flex-card">
                                    @forelse($block->exercises as $exercise)
                                    <div class="card-edit">
                                        <div class="top-content">
                                            <div class="text-content">
                                                <p class="text-h1">{{ $exercise->title }}</p>
                                                <p>
                                                    {{ $exercise->excerpt }}
                                                </p>
                                            </div>
                                            <div class="column">
                                                <div class="one">
                                                    <p>Сложность:</p>
                                                    <p class="coplexity rating-two"> Сложно </p>
                                                </div>
                                                <div class="one">
                                                    <p>Минут:</p>
                                                    <p class="number-one">{{ $exercise->time }}</p>
                                                </div>
                                                <div class="one">
                                                    <p>Оценка:</p>
                                                    <p class="number-two rating-two"> 2</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="down-content">

                                            <a href="{{ route('blocks.exercises.show', [$block->id, $exercise->id] ) }}"
                                                class="edit-btn">Подробнее...</a>
                                        </div>
                                    </div>
                                    @empty
                                    Нет упражнений в этом блоке
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
        @endforeach --}}
        <div class="row">
            <h1 class="col-12 text-center mb-5">Прогресс развития</h1>
        </div>
        <div class="row">

            <aside class="col-sm-12 col-md-3 profile-aside">
                <h4 class="h4 col-12 text-sm-center">Ваши направления:</h4>
                <ul class="track-list">
                    @foreach (auth()->user()->tracks as $track)
                    <li> <a href="#">{{ $track->title }}</a></li>
                    @endforeach
                </ul>
            </aside>
            <article class="col-sm-12 col-md-9">
                <div class="row">
                    <h4 class="h4 col-12 text-center mb-5">Направление "{{ auth()->user()->tracks[0]->title }}"</h4>
                    <div class="col-sm-12 col-md-6 table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="p-3">Куратор направления</tf>
                                    <td>{{ auth()->user()->tracks[0]->curator->all_names }}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Номер телефона куратора</td>
                                    <td>{{ auth()->user()->tracks[0]->curator->phone }}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Телеграм куратора</td>
                                    <td>{{ auth()->user()->tracks[0]->curator->tg_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-6 ">
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td class="p-3">Решено задач</tf>
                                    <td>12</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Средний балл</td>
                                    <td>3.9</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Получено оценок</td>
                                    <td>12</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="h4 col-12 text-center mt-3 mb-3">Блоки и задачи этого направления</h4>
                    <div class="col-sm-12">
                        @foreach (auth()->user()->tracks[0]->blocks as $block)
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">

                                        <p class="fs-5">
                                            Блок: {{ $block->title }}
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 d-flex justify-content-end">
                                        <form
                                        @if($block->exercises_count < 1)
                                            action="{{ '' }}"
                                            @else
                                            action="{{ '' }}"
                                            @endif class="d-inline"></form>
                                        <button type="submit" class="btn" @if($block->exercises_count < 1) disabled @endif>
                                            @if($block->exercises_count < 1)
                                            У данного блока нет упражнений
                                            @else
                                            Начать выполение блока
                                            @endif

                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex flex-md-column exercise-block">


                                    @forelse ($block->exercises as $exercise)
                                        @if($loop->first) <div class="fs-6 mt-0 mb-2">Задания блока:</div> @endif
                                        <span class="fs-6">{{ $exercise->title }}</span>
                                    @empty
                                    <div class="fs-6 mt-0 mb-2">К данному блоку ещё не добавили заданий :(</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </article>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $("input[type=text]").keydown(function(event){
      if(event.keyCode == 13){
        event.preventDefault();
          return false;
          }
      });
    </script>
@endpush
