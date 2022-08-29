@extends('profile.layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('profile_content')

        <div class="row">
            @forelse($user->tracks as $track)

                <article class="col-sm-12 col-md-9">
                    <div class="row">
                        <h4 class="h4 col-12 text-center mb-5">Направление: "{{ $track->title }}"</h4>
                        <div class="col-sm-12 col-md-6 ">
                            <table class="table table-responsive">
                                <tbody>
                                <tr>
                                    <td class="p-3">Решено задач</td>
                                    <td>{{$user->getSolvedTrackExercisesAttribute($track->id)}}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Средний балл</td>
                                    <td>{{$user->getAverageMarkTrackAttribute($track->id)}}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Получено оценок</td>
                                    <td>{{$user->getAnswerMarkCountAttribute($track->id)}}</td>
                                </tr>
                                </tbody>
                            </table>
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
