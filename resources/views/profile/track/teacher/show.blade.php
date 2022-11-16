@extends('profile.layouts.main')

@if($track->curator_id === auth()->user()->id)
    @section('title')
        Вы являетесь руководителем направления "{{ $track->title }}"
    @endsection
@else
    @section('title')
        Просмотр направления "{{ $track->title }}"
    @endsection
@endif

@section('profile_content')
    @if(isset($track))
        <div class="row">

            @if(auth()->user()->id == $track->curator_id)
                @if( $requestsToJoin->count() > 0 )

                    <div class="col-sm-12 col-md-6 mb-3">
                        <div class="card">
                            <h4 class="h4 col-12 text-center m-3">Заявки студентов на участие в направлении
                                "{{ $track->title }}"</h4>
                            <div class="card-body requests-to-track">
                                {{-- Здесь заявки студентов на этот курс, их можно принять или отклонить --}}
                                @forelse ($requestsToJoin as $user_request)
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 align-self-center">
                                                    @if(isset($user_request->user->avatar))
                                                        <img
                                                            src="{{ asset($user_request->user->avatar_thumbnail_path) }}"
                                                            class="img" alt="" style="height: 50px">
                                                    @else
                                                        <img
                                                            src="{{ asset('storage/users/avatars/thumbnail/thumbnail_default_avatar.jpg') }}"
                                                            class="img" alt="" style="height: 50px">
                                                    @endif

                                                    {{ $user_request->user->allNames }}
                                                </div>
                                                <div class="col-md-6 col-sm-12 align-self-center">
                                                    <div class="row justify-content-end">

                                                        <div class="col justify-content-end">
                                                            <form
                                                                action="{{ route('tracks.userAccepted',[$track->slug, $user_request->user->slug ] ) }}"
                                                                method="post" class="d-inline ">
                                                                @csrf
                                                                @method('put')
                                                                <button class="w-100 btn btn-success">Принять</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    <h4 class="h4 col-sm-12 col-md-6 mt-3 mb-3 text-center ">Новых заявок на это направление нет </h4>
                @endif
                @if( $requestsToRefused->count() > 0 )

                    <div class="col-sm-12 col-md-6 mb-3">
                        <div class="card">
                            <h4 class="h4 col-12 text-center m-3">Заявки студентов на отмену участия в направлении
                                "{{ $track->title }}"</h4>
                            <div class="card-body requests-to-track">
                                {{-- Здесь заявки студентов на этот курс, их можно принять или отклонить --}}
                                @forelse ($requestsToRefused as $user_request)
                                    @if(auth()->user()->id !== $user_request->user->id)
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 align-self-center">
                                                        <div>
                                                            @if(isset($user_request->user->avatar))
                                                                <img
                                                                    src="{{ asset($user_request->user->avatar_thumbnail_path) }}"
                                                                    class="img " alt="" style="height: 50px;min-height: 50px">
                                                            @else
                                                                <img
                                                                    src="{{ asset('storage/users/avatars/thumbnail/thumbnail_default_avatar.jpg') }}"
                                                                    class="img
                                                                    " alt="" style="height: 50px;min-height: 50px">
                                                            @endif
                                                        </div>
                                                       <div>
                                                           {{ $user_request->user->allNames }}
                                                       </div>

                                                    </div>
                                                    <div class="col-md-6 col-sm-12 align-self-center">
                                                        <div class="row justify-content-end">

                                                            <div class="col justify-content-end">
                                                                <form
                                                                    action="{{ route('tracks.userAccepted',[$track->slug, $user_request->user->slug ] ) }}"
                                                                    method="post" class="d-inline ">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button class="w-100 btn btn-success">Принять
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    <h4 class="h4 col-sm-12 col-md-6 text-center mb-3 mt-3">Заявок на выход из направления нет </h4>
                @endif
            @endif

            <div class="col-sm-12 mb-3">

                <div class="card" style="background: #b59be8">

                    <div class="card-body track-users">
                        <h4 class="h4 col-12 text-center mb-3">Участники направления
                            "{{ $track->title }}"</h4>
                        {{-- Студенты которые участвуют в этом напрвлении --}}
                        <div class="row">
                            @forelse ($users as $user)
                                <div class="col-md-6 col-sm-12">
                                    <a href="{{ route('profile.user.show', $user->slug) }}" class="text-decoration-none text-black">
                                    <div class="card mb-2">
                                        <div class="row">
                                            <div class="col-2 d-flex align-items-center">

                                                @if(isset($user->avatar))
                                                    <img src="{{ asset($user->avatar_thumbnail_path) }}"
                                                         class="img-thumbnail border-0" alt="" style="object-fit: contain; height: 100%; min-width: 50px" >
                                                @else
                                                    <img src="{{ asset('storage/users/avatars/thumbnail/thumbnail_default_avatar.jpg') }}"
                                                         class="img border-0" alt="">
                                                @endif
                                            </div>
                                            <div class="col-10">

                                                <div class="card-body">
                                                    <span class="card-text">{{ $user->allNames }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
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
            <div class="col-sm-12 mt-2 mb-3">
                <a href="{{ route('profile.tracks.blocks.create', $track->slug) }}" class="fs-6 btn btn-primary">Создать
                    новый блок</a>
            </div>
            <div class="col-sm-12">

                @foreach ($track->blocks as $block)
                    <div class="card mb-4">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">

                                    <a href="{{ route('profile.tracks.blocks.show', [$track->slug,$block->slug]) }}"
                                       class="fs-5 text-decoration-none">
                                        Блок: {{ $block->title }}
                                    </a>
                                </div>
                                <div class="col-sm-12 col-lg-6 d-flex justify-content-end">
                                    <a href="{{ route('profile.blocks.exercises.create', [$block->slug]) }}"
                                       class="btn btn-primary"> Добавить новое упражнение </a>
                                </div>
                            </div>
                            <div class="d-flex flex-md-column exercise-block">


                                @forelse ($block->exercises as $exercise)
                                    @if($loop->first)
                                        <div class="fs-6 mt-0 mb-2">Задания блока:</div>
                                    @endif
                                    <a href="{{ route('profile.blocks.exercises.show', [$block->slug, $exercise->slug]) }}"
                                       class="fs-6">{{ $exercise->title }}</a>
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
@endsection
