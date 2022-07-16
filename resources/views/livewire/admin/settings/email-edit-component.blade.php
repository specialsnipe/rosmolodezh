<div class="row form-group w-50" wire:ignore>
    <div class="col-8">
        <input class=" form-control" type="text" value="{{$email->email}}">
        @error('email')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <span class="btn btn-info col-2" wire:click="UpdateEmail({{$email->id}})">Изменить</span>
    <span class="btn btn-danger col-2" wire:click="DeleteEmail({{$email->id}})">Удалить</span>
</div>
