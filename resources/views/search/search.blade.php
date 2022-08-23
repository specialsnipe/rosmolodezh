@extends('layouts.main')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

<style>
    #img {
        width: 400px;
        height: 400px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="container">
    <div class="main-container-directions">
        <h1 class="h1-content mt-0 mb-4">Поиск по сайту</h1>
        <form action="{{route('search')}}" method="get"
            class="d-flex justify-content-between form-floating search-flex col-sm-12 col-md-12 col-lg-12">
            <input type="text" class="mr-3 form-control" name="search" value="{{request('search')}}"
                placeholder="search">
            <label for="floatingInput">Введите текст</label>
            <button class=" search col-sm-12 col-md-2 col-lg-2">Искать</button>
        </form>
        <div class="mt-2">
            <a class="btn btn-search-active" role="tab" href="{{route('search', ['search'=>request('search')])}}">Все</a>

            <a class="btn" role="tab"
                href="{{route('exercises.search', ['search'=>request('search')])}}">Упражнения</a>

            <a class="btn" role="tab"
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
                    <p>{!! str_replace("$search","<b>$search</b>", $result['body']) !!}</p>
                </a>
                @elseif($result['table'] == 'exercises')

                <a href="{{route('blocks.exercises.show', [$result['block_id'],$result['id']] )}}"
                    class="col-sm-12 col-md-5 search-item" style="text-decoration: none">
                    <span class="text-muted">Направление: "{{$result->block->track->title}}"</span>
                    <p class="text-muted">Блок: "{{$result->block->title}}"</p>
                    <p class="h1"> <span class="text-muted">Упражнение:</span>"{{$result['title']}}" </p>
                    <p>{!! str_replace("$search","<b>$search</b>", $result['body']) !!}</p>
                </a>
                @endif
                @empty
                <div class="search-not-found">
                    <span>Ничего не нашлось :(</span>
                    <img src="{{ asset('images/search_failed.svg') }}" alt="">
                </div>
                @endforelse
                @else
                <img src="{{asset('storage/search/search.png')}}" class="mt-3" id="img" alt="Поиcк">
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
