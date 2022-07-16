<div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div>
                        <form action="" wire:submit.prevent="AddEmail" method="post">
                            @csrf
                            <div class="form-group row w-50 mb-5 mt-3">
                                <input type="text" class="col-8 form-control " wire:model="email" placeholder="Email">
                                <button type="submit" class="col-4 btn btn-default ">Добавить новую почту</button>
                                @error('email')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </form>
                    </div>

                    <div class="mb-5">
                        @foreach($setting->emails as $email)
                            @livewire('email-edit-component', ['email'=> $email, 'setting'=> $setting])
                        @endforeach
                    </div>
                    <form action="#" wire:submit.prevent="AddPhone" method="post">
                        <div class="row w-50 mb-3">
                            <input type="text" class="col-8 form-control " wire:model="phone" placeholder="Название"
                                   value="">
                            <button type="submit" class="col-4 btn btn-default ">Добавить новый телефон</button>
                        </div>
                    </form>
                    <div class="mb-5">
                        @foreach($setting->phones as $phone)
                            <div class="row form-group w-50">
                                <span class="form-control col-10">{{$phone->phone}}</span>
                                <span class="btn btn-info col-1">Изменить</span>
                                <span class="btn btn-danger col-1">Удалить</span>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-12">
                    <form action="#" wire:submit.prevent="Update" method="post">
                        @csrf
                        <div class="form-group w-50">
                            <input type="text" class="form-control " wire:model="vk_url" value="{{$setting->vk_url}}"
                                   placeholder="Название">
                            @error('vk_url')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <input type="text" class="form-control " wire:model="tg_url" value="{{$setting->tg_url}}">
                            @error('tg_url')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50 mb-5">
                            <input type="text" class="form-control " wire:model="ok_url" value="{{$setting->ok_url}}">
                            @error('ok_url')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="Изменить">
                    </form>
                </div>


            </div>
            <!-- /.row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>
