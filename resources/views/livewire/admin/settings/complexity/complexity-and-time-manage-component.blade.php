<div class="row m-3">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <span class="h5">Сложности</span>
            </div>
            <div class="card-body">
                @foreach ($complexities as $complexity)
                    <div class="form-group">
                        <div class="btn btn-{{ $complexity->class_name }}">
                            {{ $complexity->name }}
                        </div> -
                        {{ $complexity->body }}
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <span class="h5">Время на выполнение заданий</span>
            </div>
            <div class="card-body">
                @foreach ($complexity_times as $c_time)
                    <div class="form-group">
                        <div class="btn btn-{{ $c_time->class_name }}">
                            {{ $c_time->class_name }}
                        </div> (
                            {{ $c_time->started_at }}
                            :
                            {{ $c_time->ended_at }}
                        )
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
