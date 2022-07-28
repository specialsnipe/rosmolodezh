@extends('layouts.main')

@section('content')

<section>
      <p class="h1-content">Новости</p>
      <div class="news-block container-fluid">
        <div class="card-form row d-flex justify-content-between">
        <x-index-posts></x-index-posts>
        </div>
        <nav  aria-label="...">
          <ul class="pagination mt-4 justify-content-end">
            <li class="page-item disabled">
              <span class="page-link">Предыдущая</span>
            </li>
            <li class="page-item active" aria-current="page">
              <span class="page-link">1</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">6</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Следующая</a>
            </li>
          </ul>
        </nav>
    </section>

@guest
<x-registration-form></x-registration-form>
@endguest
@endsection

