@extends('layouts.main')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
<div class="container">


    <div class="main-container-directions">
        <div class="row">
            <h1 class="col-12 text-center mb-5">
                @if(isset($isCurator))
                Вы являетесь куратором этого направления {{ $isCurator->title }}
                @else
                Управление
                @endif
            </h1>
        </div>
        <div class="row">

            <aside class="col-sm-12 col-md-3 profile-aside">
                <h4 class="h4 col-12 ">Ваши направления:</h4>
                <ul class="track-list">
                    @foreach (auth()->user()->tracks as $track)
                    <li> <a href="#">{{ $track->title }}</a></li>
                    @endforeach
                </ul>
                <h4 class="h4 col-12 ">Направления где вы руководитель:</h4>
                <ul class="track-list">
                    @foreach (auth()->user()->tracks as $track)
                    <li> <a href="#">{{ $track->title }}</a></li>
                    @endforeach
                </ul>
            </aside>
            <article class="col-sm-12 col-md-9">
                @if(isset(auth()->user()->tracks[0]))
                <div class="row">
                    <div class="col-sm-12  mb-3">
                        <div class="card">
                            <h4 class="h4 col-12 text-center m-3 mb-0">Заявки студентов на участие в направлении
                                "{{ auth()->user()->tracks[0]->title }}"</h4>
                            <div class="card-body requests-to-track">
                                {{-- Здесь заявки студентов на этот курс, их можно принять или отклонить --}}
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 align-self-center">
                                                <img src="{{ asset('storage/users/avatars/thumbnail/thumbnail_default_avatar.jpg') }}"
                                                    class="img img-thumbnail" alt="" style="height: 50px">
                                                Абдулах Максим Европович
                                            </div>
                                            <div class="col-md-6 col-sm-12 align-self-center">
                                                <div class="row justify-content-end">
                                                    <div class="col justify-content-end">
                                                        <button class="w-100 btn btn-success">Принять</button>
                                                    </div>
                                                    <div class="col justify-content-end">

                                                        <button class="w-100 btn btn-danger">Отменить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 align-self-center">
                                                <img src="{{ asset('storage/users/avatars/thumbnail/thumbnail_default_avatar.jpg') }}"
                                                    class="img img-thumbnail" alt="" style="height: 50px">
                                                Абдулах Максим Европович
                                            </div>
                                            <div class="col-md-6 col-sm-12 align-self-center">
                                                <div class="row justify-content-end">
                                                    <div class="col justify-content-end">
                                                        <button class="w-100 btn btn-success">Принять</button>
                                                    </div>
                                                    <div class="col justify-content-end">

                                                        <button class="w-100 btn btn-danger">Отменить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 align-self-center">
                                                <img src="{{ asset('storage/users/avatars/thumbnail/thumbnail_default_avatar.jpg') }}"
                                                    class="img img-thumbnail" alt="" style="height: 50px">
                                                Абдулах Максим Европович
                                            </div>
                                            <div class="col-md-6 col-sm-12 align-self-center">
                                                <div class="row justify-content-end">
                                                    <div class="col justify-content-end">
                                                        <button class="w-100 btn btn-success">Принять</button>
                                                    </div>
                                                    <div class="col justify-content-end">

                                                        <button class="w-100 btn btn-danger">Отменить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">

                        <div class="card">
                            <h4 class="h4 col-12 text-center m-3 mb-0">Участники данного направления
                                "{{ auth()->user()->tracks[0]->title }}"</h4>
                            <div class="card-body track-users">
                                {{-- Студенты которые участвуют в этом напрвлении --}}
                                <div class="row">
                                    @forelse (auth()->user()->tracks[0]->users as $user)

                                    <div class="col-2">
                                        <div class="card mb-2 bg-dark text-center">
                                            <img src="{{ asset('storage/users/avatars/thumbnail/thumbnail_default_avatar.jpg') }}"
                                            class="img-thumbnail" alt="">
                                            <div class="card-body">
                                                <a href="{{ route('user.show', $user->id) }}" class="card-text text-white">{{ $user->allNames }}</a>
                                            </div>

                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-12">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                В этом направлении нет пользователей
                                            </div>
                                        </div>
                                    </div>
                                    @endforelse

                                </div>

                            </div>
                        </div>
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
                                        <form @if($block->exercises_count < 1) action="{{ '' }}" @else action="{{ '' }}"
                                                @endif class="d-inline">
                                        </form>
                                        <button type="submit" class="btn" @if($block->exercises_count < 1) disabled
                                                @endif>
                                                @if($block->exercises_count < 1) У данного блока нет упражнений @else
                                                    Начать выполение блока @endif </button>
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
                @else
                <div class="row">

                </div>
                @endif

            </article>
        </div>
    </div>
</div>
@endsection
