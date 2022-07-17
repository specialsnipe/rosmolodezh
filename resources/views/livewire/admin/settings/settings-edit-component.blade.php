<div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div>
                        <form action="" wire:submit.prevent="AddEmail" method="post">
                            @csrf
                            <div class="form-group row w-50 ml-1 mb-3 mt-3">
                                <input type="text" class="col-6 form-control " wire:model="email" placeholder="Email">
                                <button type="submit" class="col-4 btn btn-default ">Добавить новую почту</button>
                                @error('email')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </form>
                    </div>

                    <div class="mb-5">
                        @foreach($setting->emails as $email)
                            <div class="row form-group w-50 ml-5">
                                <span class="col-6 form-control ml-1 mr-1">{{$email->email}} </span>
                                <span class="btn btn-danger col-2" wire:click.prevent="DeleteEmail({{$email->id}})">Удалить</span>
                            </div>
                        @endforeach
                    </div>
                    <form action="#" wire:submit.prevent="AddPhone" method="post">
                        @csrf
                        <div class="form-group row w-50 mb-3 ml-1">
                            <input  type="text" class="col-6 form-control " wire:model="phone" placeholder="Телефон"
                                   value="">
                            <button type="submit" class="col-4 btn btn-default ">Добавить новый телефон</button>
                            @error('phone')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </form>
                    <div class="mb-5">
                        @foreach($setting->phones as $phone)
                            <div class="row form-group w-50 ml-5">
                                <span class="form-control col-6 ml-1 mr-1">{{$phone->phone}}</span>
                                <span class="btn btn-danger col-2" wire:click.prevent ="DeletePhone({{$phone->id}})">Удалить</span>
                            </div>
                        @endforeach
                    </div>

                </div>


            </div>
            <!-- /.row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>
