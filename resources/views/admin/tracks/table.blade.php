@extends('admin.layouts.main')


@push('style')
@livewireScripts
@endpush

@section('content')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Таблица "Направления"</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Главная</a></li>
                        <li class="breadcrumb-item active">Таблица "Направления"</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <div class="m-3" id="accordion" role="tablist" aria-multiselectable="true">

                {{-- <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne">
                                Фильтр по пользователям
                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="card-block">
                            <form action="{{route('admin.users.index')}}" method="get" class="p-3">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 ">
                                        <label>Траектория</label>
                                        <select class="select2" name="track_id[]" multiple="multiple"
                                            data-placeholder="Выберите траекторию" style="width: 100%;">
                                            @foreach($tracks as $track)
                                            <option {{is_array(request()->track_id)&&
                                                in_array($track->id,request()->track_id)?'selected':''}}
                                                value="{{$track->id}}">{{$track->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info">Применить фильтр</button>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>

            @if(session()->has('error'))
                <div class="m-3 alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('error') }}
                </div>
            @endif
            <div class="m-3">
                <a href="{{route('admin.users.create')}}" class="col-sm-12 col-md-4 btn btn-primary">Добавить
                    пользователя</a>
            </div>

            <div class="card m-3">

                <div class="card-head p-3">
                    <h3 class="card-title"></h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Кол-во блоков</th>
                                <th>Кол-во обучающихся</th>
                                <th>Успеваемость</th>
                                <th>Средний балл</th>
                                <th>Управление</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tracks as $track)

                            <tr>
                                <td>{{ $track->id }}</td>
                                <td>{{ $track->title }}</td>
                                <td>{{ $track->blocks_count }}</td>
                                <td>{{ $track->users_count }}</td>
                                <td>{{ $track->academicPerformance }}</td>
                                <td>{{ $track->averageMark }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.tracks.edit', [$track->id]) }}">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger delete-track" data-track="{{ $track->id }}"  >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a class="btn btn-default" href="{{ route('admin.tracks.show', [$track->id]) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <x-modal name="Вы уверены что хотите удалить этот трек?" type="delete"
                                        action="{{ route('admin.tracks.table.destroy', [$track->id]) }}" targetid="{{ 'deleteTrack_' . $track->id }}">
                                    </x-modal>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Направлений нет</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card m-3 p-3">
                    {{ $tracks->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        window.onload = () => {

            const modals = document.querySelectorAll('.modal');
            const buttons = document.querySelectorAll('.delete-track');

            document.addEventListener('keyup', function(ev) {
                if (ev.keyCode === 27) {
                    modals.forEach((modal) => {
                        modal.style.display = 'none';
                    })
                }
            })

            buttons.forEach((button) => {
                button.addEventListener('click', (ev) => {
                    ev.preventDefault();
                    const trackId = button.dataset.track;
                    let currModal;
                    modals.forEach((modal) => {
                        modal.style.display = 'none';
                        if (modal.id.split('_')[1] === trackId) {
                            modal.style.display = 'block';
                        }
                    })
                });
            })
            modals.forEach(function(modal) {
                // console.log(modal);
                const closeBtn = modal.querySelector('button#closeModal');

                closeBtn?.addEventListener('click', function () {
                    modal.style.display = 'none';
                });
            })

        }
    </script>
@endpush
