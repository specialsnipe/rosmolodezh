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
                                        <span class="info-track__title">Решено задач</span>
                                        <span>{{$user->getSolvedTrackExercisesAttribute($track->id)}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info-track">
                                        <span class="info-track__title">Средний балл</span>
                                        <span>{{$user->getAverageMarkTrackAttribute($track->id)}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info-track">
                                        <span class="info-track__title">Получено оценок</span>
                                        <span>{{$user->getAnswerMarkCountAttribute($track->id)}}</span>
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
