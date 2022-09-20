@props(['show','name', 'type', 'action', 'targetid'])


<div class="modal fade @if(isset($show)) show @endif" id="@if(isset($targetid)){{ $targetid }}@endif" tabindex="-1" role="dialog" aria-labelledby="@if(isset($targetid)){{ $targetid . 'Label' }}@endif" aria-hidden="true"  @if(isset($show)) style="display: block" @endif>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="@if(isset($targetid)){{ $targetid .'Label'}}@endif @if(isset($id)) {{$id}} @endif">@if(isset($name)) {{ $name }}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($type))
                    @if($type == 'delete')
                        <form action="{{ $action }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Пароль</label>
                                <input type="password" name="password" class="form-control" id="recipient-name">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id='closeModal'>Отмена</button>
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </div>
                        </form>
                    @endif
                    @if($type == 'info')
                        {{ $info }}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        </div>
                    @endif
                    @if($type == 'error')
                        {{ $info }}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ОК, ПОПРОБУЮ СНОВА!</button>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
