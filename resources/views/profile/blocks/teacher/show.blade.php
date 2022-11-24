@php
    use Illuminate\Support\Carbon;
    $user = auth()->user();
@endphp

@extends('profile.layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <style>
        @media (min-width: 280px) and (max-width: 770px) {
            .fs-4 {
                margin-bottom: 3rem !important;
            }
        }
    </style>
@endpush
@section('title')
    <div class="row">
        @if($block->beforeBlockUrl)
            <div class="col-sm-12 col-md-2 mb-5 d-block d-lg-block d-md-block d-sm-none"><a
                    href="{{ $block->beforeBlockUrl }}" class="btn btn-primary w-100">Предыдущий
                    блок</a></div>
        @else
            <div class="col-2"></div>
        @endif


        <div class="col-sm-12 col-md-8">
            <span class="fs-2 mb-5"> Направление "{{ $block->track->title }}"</span> <br>
            <span class="fs-4 d-flex justify-content-center align-items-center"> Блок "{{ $block->title }}"</span>
        </div>

        @if($block->beforeBlockUrl)
            <div class="col-sm-6 col-md-2 mb-5 d-none d-lg-none d-md-none d-sm-block"><a
                    href="{{ $block->beforeBlockUrl }}" class="btn btn-primary w-100">Предыдущий
                    блок</a></div>
        @else
            <div class="col-2"></div>
        @endif

        @if($block->nextBlockUrl)
            <div class="col-sm-6 col-md-2"><a href="{{ $block->nextBlockUrl }}" class="btn btn-primary w-100">Следующий
                    блок</a>
            </div>
        @else
            <div class="col-2"></div>
        @endif
    </div>
@endsection
@section('profile_content')
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <img src="{{ $block->imageNormal }}" alt="" class="img-fluid single-image rounded">
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="d-flex justify-content-end mb-3">
                    <div class="p-2" style="padding-top: 0 !important;padding-bottom: 0 !important;">
                        <a href="{{ route('profile.tracks.blocks.edit', [$track->slug, $block->slug]) }}"
                           class="btn btn-light pl-2 pt-1 pb-1 pr-2" style="font-size:10px">Редактировать блок</a>
                    </div>
                    <div class="p-2"
                         style="padding-top: 0 !important;padding-bottom: 0 !important;padding-right: 0 !important;">
                        <button role="button" class="btn btn-danger pl-3 pt-1 pb-1 pr-2" style="font-size:10px"
                                data-toggle="modal" data-target="#deleteBlock" id="delete"> Удалить блок
                        </button>
                    </div>
                </div>


                <h4 class="h4 text-center">Задания данного блока:</h4>
                <x-modal name="Вы уверены что хотите удалить этот блок?" type="delete"
                         action="{{ route('profile.tracks.blocks.destroy', [$block->slug, $block->slug]) }}"
                         targetid="deleteBlock">
                </x-modal>
                <script>
                    $('#delete').on('click', function (ev) {
                        $($(this).data('target')).show();
                        $($(this).data('target')).css({opacity: 1})
                    });
                    $('#closeModal').on('click', function (ev) {
                        $('#deleteBlock').hide();
                    })
                </script>
            </div>
            <div class="col-12 mb-3">
                <a href="{{ route('profile.blocks.exercises.create', $block->slug) }}"
                   class="btn btn-primary pl-2 pt-1 pb-1 pr-2"
                   style="font-size:10px">Добавить новое задание</a>
            </div>
            <div class="col-12">

                <div class="card-body table-responsive">
                    <ul class="list-group">
                        @forelse($block->exercises as $exercise)
                            <li class="list-group-item" id="{{ "exercise_" . $exercise->slug }}">
                                <div class="row my-2">
                                    <div class="col-1 text-center">
                                        <div class="h3 fw-light">{{ $loop->index + 1 }}</div>
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                            <h4 class="col-12 d-flex justify-content-between align-items-center">
                                                <a class="text-decoration-none link-dark me-2"
                                                   href="{{ route('profile.blocks.exercises.show', [$block->slug, $exercise->slug]) }}">{{
                                            $exercise->title }}</a>
                                                <a href="{{ route('profile.blocks.exercises.edit', [$block->slug, $exercise->slug]) }}"
                                                   class="btn btn-light"
                                                   style="font-size:10px">Редактировать</a>

                                            </h4>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <span>Уровень освоения: </span>
                                                <h5 style="display: inline"><span
                                                        title="{{ $exercise->complexity->body }}"
                                                        class="badge bg-{{ $exercise->complexityClassName }}">
                                                    {{ $exercise->complexity->level }} </h5>
                                            </div>
                                            <div class="col-sm-12 mt-1">
                                                <span> Время на выполнение:</span>
                                                <h5 style="display: inline">
                                            <span class="badge bg-{{ $exercise->complexityTimeClassName }}">
                                                {{ $exercise->time }} {{ $exercise->name_minute_count }}
                                            </span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-muted text-truncate" style="max-height: 40px">
                                            {!! $exercise->excerpt !!}
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a href="{{ route('profile.blocks.exercises.show',[$block->slug, $exercise->slug]) }}"
                                               class="btn btn-primary align-self-end"> Просмотр упражнений и ответов</a>
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
            <div class="col-12">
                <div class="row mt-3">
                    @if($block->beforeBlockUrl)
                        <div class="col-md-6 col-sm-6 mb-5"><a href="{{ $block->beforeBlockUrl }}"
                                                               class="btn btn-secondary w-100">Предыдущий
                                блок</a></div>
                    @else
                        <div class="col-6"></div>
                    @endif
                    @if($block->nextBlockUrl)
                        <div class="col-md-6 col-sm-6"><a href="{{ $block->nextBlockUrl }}"
                                                          class="btn btn-secondary w-100">Следущий
                                блок</a></div>
                    @else
                        <div class="col-6"></div>
                    @endif
                </div>
            </div>
        </div>
@endsection
@push('script')
    <script>
        $("input[type=text]").keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        const singleImage = document.querySelector('.single-image');
        if (singleImage) {
            let ghostingImage = singleImage.cloneNode(true);
            ghostingImage.style.maxWidth = '100%';
            ghostingImage.style.width = '100%';
            ghostingImage.style.maxHeight = '100%';
            ghostingImage.style.height = '100%';
            ghostingImage.style.position = 'absolute';
            ghostingImage.style.objectFit = 'cover';
            ghostingImage.style.zIndex = '1';
            ghostingImage.style.opacity = '0.2';

            singleImage.parentNode.style.position = 'relative';
            singleImage.style.zIndex = '10';
            singleImage.parentNode.appendChild(ghostingImage);

        }
    </script>
@endpush
