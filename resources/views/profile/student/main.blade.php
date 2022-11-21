@extends('profile.layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('title') Ваша статистика @endsection
@section('profile_content')

        <div class="row">
            @forelse($user->tracks as $track)

                <article class="col-sm-12">
                    <div class="row">
                        <h4 class="h4 col-12 text-center mb-3">Направление: "{{ $track->title }}"</h4>
                        <div class="col-12" style="padding:0 10px 0 10px">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="info-track">
                                        <div class="info-track__title">Решено задач</div>
                                        <div>{{$user->getSolvedTrackExercisesAttribute($track->id)}}</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info-track">
                                        <div class="info-track__title">Средний балл</div>
                                        <div>{{$user->getAverageMarkTrackAttribute($track->id)}}
                                            <img style="object-fit: contain; width: 100%"
                                                src="https://raw.githubusercontent.com/NikitaMurugov/PortfolioDex/04f8384659f5129d660ed56aaeab0679a495c02b/Images/star_group.svg" alt="stars">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info-track">
                                        <div class="info-track__title">Получено оценок</div>
                                        <div>{{$user->getAnswerMarkCountAttribute($track->id)}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                У вас нет направлений
            @endforelse

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
