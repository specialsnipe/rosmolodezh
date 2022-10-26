@props(['show','name', 'type', 'action', 'targetid'])


<div class="modal @if(isset($show)) show @endif" id="@if(isset($targetid)){{ $targetid }}@endif" tabindex="-1" role="dialog"
    aria-labelledby="@if(isset($targetid)){{ $targetid . 'Label' }}@endif" aria-hidden="true"  @if(isset($show))
    style="display: block; " @endif style="background: #00000033;">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
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
                            <div class=" mb-3 ">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <label for="message-text" class="col-form-label">Пароль</label>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-9">
                                        <input type="password" name="password" class="form-control w-100" id="recipient-name">
                                    </div>
                                </div>
                            </div>
                            <div class="p-0">
                                <div class=" mt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-secondary w-100" data-dismiss="modal" id='closeModal'>Отмена</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-danger w-100 ">Удалить</button>
                                        </div>
                                    </div>
                                </div>
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
