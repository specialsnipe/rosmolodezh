<div>
    <div class="row m-3">
        <div class="col-sm-12 col-lg-4" style="padding: 0">
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
                    @forelse($information->emails as $email)
                    <div class="card  bg-gradient-light ">
                        <div class="card-body">
                            <div class="row form-group  mb-0 col-sm-12 d-flex justify-content-between align-items-center">
                                 <span class="h5"><i class="fa fa-envelope"></i> {{$email->email}} </span>
                                 <span class="btn btn-danger"
                                 wire:click.prevent="DeleteEmail({{$email->id}})">Удалить</span>
                            </div>
                            <div class="row form-group col-sm-12 mb-0">
                                <span class=" ">{{$email->description}} </span>
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
        <div class="col-sm-12 col-lg-4">
            <div class="card col-sm-12 ">
                <div class="card-body">
                    <form action="#" wire:submit.prevent="AddTelegram" method="post" class="row">
                        @csrf
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="tg_username">Telegram username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                  </div>
                                  <input type="text" class=" form-control " wire:model="tg_username" id="tg_username"
                                  placeholder="userNameTg" value="">
                            </div>

                            @error('tg_username')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="tg_description">Чей username</label>
                            <input type="text" class=" form-control " wire:model="tg_description" id="tg_description"
                                placeholder="Основной куратор проектов" value="">
                            @error('tg_description')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-gorup col-12">

                            <button type="submit" class="btn btn-primary w-100">Добавить новый аккаунт</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card col-sm-12">
                <div class="card-header">
                    <h4> Уже добавленные телеграм аккаунты</h4>
                </div>
                <div class="card-body">
                    @forelse($information->telegrams as $tg)

                    <div class="card  bg-gradient-light">
                        <div class="card-body">
                            <div class="row form-group  mb-0 col-sm-12 d-flex justify-content-between align-items-center">
                                 <span class="h5"><svg class="pr-2" style="width:30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"/></svg>
                                    <a target="_blank" href="https://t.me/{{$tg->username}}"> {{ "@".$tg->username}} </a></span>
                                 <span class="btn btn-danger"
                                 wire:click.prevent="DeleteTelegram({{$tg->id}})">Удалить</span>
                            </div>
                            <div class="row form-group col-sm-12 mb-0">
                                <span class=" ">{{$tg->description}} </span>
                            </div>
                        </div>
                    </div>
                    @empty

                    <div class="card">
                        <div class="card-body">
                            <div class="row form-group col-sm-12" style="margin: 0">
                                <span class="h5" style="margin: 0">
                                    <svg class="pr-2" style="width:30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"/></svg>
                                    Ни одного телеграм акаунта ещё не добавлено </span>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
