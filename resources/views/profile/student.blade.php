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
                @foreach ($blocks as $block)
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

                                                    <a href="{{ route('blocks.exercises.show', [$block->id, $exercise->id] ) }}" class="edit-btn">Подробнее...</a>
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
                @endforeach
        </div>
    </div>
    @endsection
