<div>
    <div class="row m-3">
        <div class="col-sm-12 col-lg-6" style="padding: 0">
            <div class="card col-sm-12 ">
                <div class="card-body">
                    <form action="" wire:submit.prevent="AddEmail" method="post" class="row">
                        @csrf
                        <div class="form-group col-sm-12 col-md-4">
                            <label for="email">Название почты</label>
                            <input type="text" class=" form-control " wire:model="email" placeholder="email@example.com"
                                id='email'>
                            @error('email')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12 col-md-8">
                            <label for="email_description">Описание почты</label>
                            <input type="text" class=" form-control " wire:model="email_description"
                                id='email_description' placeholder="Почта куратора">

                            @error('email_description')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12" style="margin-bottom:0 ">
                            <button type="submit" class="btn btn-primary w-100">Добавить новую почту</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card col-sm-12">
                <div class="card-header">
                    <h4> Уже добавленные почты</h4>
                </div>
                <div class="card-body">
                    @forelse($setting->emails as $email)
                    <div class="card">
                        <div class="card-body">

                            <div class="row form-group col-sm-12">
                                 <span class="h5"><i class="fa fa-envelope"></i> {{$email->email}} </span>
                            </div>
                            <div class="row col-12 text-center">

                            </div>
                            <div class="row form-group col-sm-12">
                                <span class=" ">{{$email->description}} </span>
                            </div>
                            <div class="form-group row col-sm-12">
                                <span class="btn btn-danger w-100"
                                    wire:click.prevent="DeleteEmail({{$email->id}})">Удалить</span>
                            </div>
                        </div>
                    </div>
                    @empty

                    <div class="card">
                        <div class="card-body">
                            <div class="row form-group col-sm-12" style="margin: 0">
                                <span class="h5" style="margin: 0"><i class="fa fa-envelope"></i> Ни одной почты ещё не добавлено </span>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="card col-sm-12 ">
                <div class="card-body">
                    <form action="#" wire:submit.prevent="AddPhone" method="post" class="row">
                        @csrf
                        <div class="form-group col-sm-12 col-md-4">
                            <label for="phone">Номер телефона</label>
                            <input type="text" class=" form-control " wire:model="phone" id="phone"
                                placeholder="+7(000)000-00-00" value="">
                            @error('phone')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12 col-md-8">
                            <label for="phone_description">Описание номера телефона</label>
                            <input type="text" class=" form-control " wire:model="phone_description" id="phone_description"
                                placeholder="Для связи с куратором" value="">
                            @error('phone_description')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-gorup col-12">

                            <button type="submit" class="btn btn-primary w-100">Добавить новый телефон</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card col-sm-12">
                <div class="card-header">
                    <h4> Уже добавленные телефоны</h4>
                </div>
                <div class="card-body">
                    @forelse($setting->phones as $phone)
                    <div class="card">
                        <div class="card-body">

                            <div class="row form-group col-sm-12">
                                <span class="h5"><i class="fa fa-phone"></i> {{$phone->phone}}</span>
                            </div>
                            <div class="row form-group col-sm-12">
                                <span class="">{{$phone->description}}</span>
                            </div>
                            <div class="row form-group col-12">

                                <span class="btn btn-danger w-100"
                                    wire:click.prevent="DeletePhone({{$phone->id}})">Удалить</span>
                            </div>
                        </div>
                    </div>
                    @empty

                    <div class="card">
                        <div class="card-body">
                            <div class="row form-group col-sm-12" style="margin: 0">
                                <span class="h5" style="margin: 0"><i class="fa fa-phone"></i> Ни одного телефона ещё не добавлено </span>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
