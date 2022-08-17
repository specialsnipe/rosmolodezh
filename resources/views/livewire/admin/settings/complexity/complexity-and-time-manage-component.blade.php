<div class="row m-3">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <span class="h5">Сложности</span>
            </div>
            <div class="card-body">
                @foreach ($complexities as $complexity)
                <div class="form-group d-flex justify-content-between align-items-center">
                    <div>
                        <div class=" badge bg-{{ $complexity->class_name }}">
                            <span class="h5">{{ $complexity->name }} ({{ $complexity->level }}) </span>
                        </div> -
                        {{ $complexity->body }}
                    </div>
                    <div class="btn-group">
                        <a wire:click="openComplexityChangeModal({{ $complexity->id }})" class="btn btn-light"> Изменить</a>
                        <a wire:click="openComplexityDeleteModal({{ $complexity->id }})" class="btn btn-danger"> Удалить</a>
                    </div>
                </div>
                <hr>
                @endforeach
                <div class="btn-group">
                    <div class="btn btn-primary" wire:click="openComplexityCreateModal">
                        Добавить новую сложность
                    </div>
                </div>
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
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <div class=" badge bg-{{ $c_time->class_name }}">
                            <span class="h5">{{ $c_time->started_at }} : {{ $c_time->ended_at }} </span>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a wire:click="openTimeChangeModal({{ $c_time->id }})" class="btn btn-light"> Изменить</a>
                        <a wire:click="openDeleteTimeModal({{ $c_time->id }})" class="btn btn-danger"> Удалить</a>
                    </div>
                </div>
                <hr>
                @endforeach
                <div class="btn-group">
                    <div class="btn btn-primary" wire:click="openTimeCreateModal">
                        Добавить новый интервал
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($modal_opened)
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{!! $modal_title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>{!! $modal_info !!}</span>
                @error('modalError')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @if($modal_inputs != [])
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        @foreach ($modal_inputs as $modal_input)
                        <div class="col-6 {{ $modal_input['size'] ?? '' }}">
                            <div class="form-group">
                                @if($modal_input['type'] !== 'select')
                                <label for=""> {!! $modal_input['title'] !!}</label>
                                <input
                                    class="form-control @if(isset($modal_input['wire_model'])) @error($modal_input['wire_model']) is-invalid @enderror @endif"
                                    type="{{ $modal_input['type'] }}"
                                    @if($modal_input['name']=='started_at' )
                                    disabled
                                    @endif
                                    @if( isset($modal_input['wire_model']))
                                    wire:model='{{ $modal_input['wire_model']  }}'
                                    @endif
                                    name="{{ $modal_input['name'] }}"
                                    value="{{ $modal_input['value'] }}">
                                    @if(isset($modal_input['wire_model']))
                                        @error($modal_input['wire_model'])
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    @endif
                                @else
                                <label for=""> {{ $modal_input['title'] }}</label>
                                <select class="form-control bg-{{ $modalDataClassName }}"
                                    name="{{ $modal_input['name'] }}" id="{{ $modal_input['name'] }}"
                                    wire:model='modalDataClassName'>
                                    @foreach ($colors as $color)
                                        <option class="bg-{{ $color }}" value="{{ $color }}"
                                        @if(isset($target_complexity_time))
                                            @if($target_complexity_time->class_name == $color) selected @else selected @endif

                                        @endif
                                        >
                                            {{ $color }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
            @endif
            <div class="modal-footer">
                @foreach ($modal_buttons as $m_button)
                <button type="button" class="btn {{ $m_button['class_btn'] }}" wire:click="{{ $m_button['action'] }}"> {{
                    $m_button['name'] }}</button>
                @endforeach
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Отмена</button>
            </div>
        </div>
    </div>

    <div class="modal-bg" tabindex="-1" role="dialog" style="display:block" wire:click="closeModal"></div>
    @endif
</div>
