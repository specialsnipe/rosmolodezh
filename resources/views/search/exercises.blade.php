@extends('layouts.main')
@push('styles')
    <style>
        #img {
            width: 400px;
            height: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush
@section('content')

    <div class="container">
        <div class="main-container-directions">
            <h1 class="h1-content mt-0 mb-4">Поиск по сайту</h1>
            <form action="{{route('exercises.search')}}" method="get"
                  class="d-flex justify-content-between form-floating col-sm-12 col-md-10 col-lg-12">
                <input type="text" class="mr-3 form-control" name="search" value="{{request('search')}}"
                       placeholder="search" id="search">
                <label for="search">Введите текст</label>
                <button class=" search col-sm-12 col-md-2 col-lg-2">Искать</button>
            </form>
            <div class="mt-2">
                <a class="btn" href="{{route('search', ['search'=>request('search')])}}">Все</a>

                <a class="btn btn-search-active"
                   href="{{route('exercises.search', ['search'=>request('search')])}}">Упражнения</a>

                <a class="btn"
                   href="{{route('posts.search', ['search'=>request('search')])}}">Новости</a>
            </div>
            <div class="search-content">
                <div class="row">
                    @if($exercises)
                        @forelse($exercises as $exercise)
                            @if($exercise->block != null)
                                <a href="{{route('blocks.exercises.show', [$exercise['block_id'],$exercise['id']] )}}"
                                   class="col-sm-12 col-md-5 search-item" style="text-decoration: none">
                                    <span class="text-muted">Направление: "{{$exercise->block->track->title}}"</span>
                                    <p class="text-muted">Блок: "{{$exercise->block->title}}"</p>
                                    <p class="h1"><span class="text-muted">Упражнение:</span>"{{$exercise['title']}}"
                                    </p>
                                    <p>{!! str_replace("$search","<b>$search</b>", $exercise['body']) !!}</p>
                                </a>
                            @endif
                        @empty
                            <div class="search-not-found">
                                <span>Ничего не нашлось :(</span>
                                <img src="{{ asset('images/search_failed.svg') }}" alt="">
                            </div>
                        @endforelse
                    @else
                        <img src="{{asset('images/search/search.png')}}" class="mt-3" id="img" alt="Поиcк">
                    @endif
                </div>
            </div>
            @if(isset($exercises) && $exercises->links()->paginator->total() > $exercises->links()->paginator->perPage())
                <div class="card">
                    <div class="card-body">
                        {{ $exercises->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
