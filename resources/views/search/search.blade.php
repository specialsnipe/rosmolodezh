@extends('layouts.main')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/media.css') }}">
        <style>
            #img {
                width: 400px;
                height: 400px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    @endpush



    <div class="container">
        <div class="main-container-directions">
            <h1 class="h1-content mt-0 mb-4">Поиск по сайту</h1>
            <form action="{{route('search')}}" method="get"
                  class="d-flex justify-content-between form-floating search-flex col-sm-12 col-md-12 col-lg-12">
                <input type="text" class="mr-3 form-control" name="search" value="{{request('search')}}"
                       placeholder="search" id="search">
                <label for="search">Введите текст</label>
                <button class=" search col-sm-12 col-md-2 col-lg-2">Искать</button>
            </form>
            <div class="mt-2">
                <a class="btn mb-2 btn-search-active" href="{{route('search', ['search'=>request('search')])}}">Все</a>

                <a class="btn mb-2"
                   href="{{route('exercises.search', ['search'=>request('search')])}}">Упражнения</a>

                <a class="btn mb-2"
                   href="{{route('posts.search', ['search'=>request('search')])}}">Новости</a>
            </div>
            <div class="search-content">
                <div class="row">
                    @if(isset($results))
                        @forelse($results as $result)
                            @if ($result['table'] == 'posts')

                                <a href="{{route('posts.show', $result['id'])}}" class="col-sm-12 col-md-5 search-item"
                                   style="text-decoration: none">
                                    <span class="text-muted">Новость</span>
                                    <p class="h1">{{$result['title']}} </p>
                                    <p>{!! str_replace("$search","<b>$search</b>", $result['excerpt']) !!}</p>
                                </a>
                            @elseif($result['table'] == 'exercises')
                                @if($result->block != null)
                                    <a href="{{route('profile.blocks.exercises.show', [$result['block_id'],$result['id']] )}}"
                                       class="col-sm-12 col-md-5 search-item" style="text-decoration: none">
                                        <span class="text-muted">Направление: "{{$result->block->track->title}}"</span>
                                        <p class="text-muted">Блок: "{{$result->block->title}}"</p>
                                        <p class="h1"><span class="text-muted">Упражнение:</span>"{{$result['title']}}"
                                        </p>
                                        <p>{!! str_replace("$search","<b>$search</b>", $result['body']) !!}</p>
                                    </a>
                                @endif
                            @endif
                        @empty
                            <div class="search-not-found">
                                <span>Ничего не нашлось :(</span>
                                <img src="{{ asset('images/search_failed.svg') }}" alt="">
                            </div>
                        @endforelse
                    @else
                        <div class="search-not-found">
                            <span>Начнём поиск?</span>
                            <img src="{{ asset('images/start_search.svg') }}" alt="">
                        </div>
                    @endif
                </div>
            </div>
            @if(isset($results) && $results->links()->paginator->total() > $results->links()->paginator->perPage())
                <div class="card">
                    <div class="card-body">
                        {{ $results->withQueryString()->links() }}</div>
                </div>
            @endif
        </div>
    </div>

@endsection
