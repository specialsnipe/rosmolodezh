<div class="card">
    <div class="card-body">
        <h3>Студенты направления:</h3>
        <div class="line mt-3 mb-3"></div>

        <div class="row">
            @foreach ($students as $student)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card"
                        @if($student->getAnswer($exercise) != null)
                            style="border: 1px solid var(--{{ $student->getAnswer($exercise)->class_name }}) !important"
                        @endif
                        >
                        <div class="card-body" style="font-size: .8rem">

                            <a target="_blank" href="{{ route('user.show', $student->id) }}">{{ $student->first_and_last_names }}</a>
                            @if($student->getAnswer($exercise) != null)

                                    @if($student->getAnswer($exercise)->mark !== null )
                                        <span class="mt-1 badge bg-{{ $student->getAnswer($exercise)->class_name }}"  style="font-size: .8rem">
                                            Оценка: {{ $student->getAnswer($exercise)->mark }}
                                        </span>
                                    @else
                                        <span class="mt-1 badge bg-light"  style="font-size: .8rem">
                                            Не оценено
                                        </span>
                                    @endif
                                    <a href="" class="btn btn-primary mt-2 "  style="font-size: .8rem">Посмотреть ответ</a>
                                @else
                                    <div class="fs-6 text-center w-100 mt-2 ">Ответа нет</div>
                                @endif
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
