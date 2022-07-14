<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('message') }}
        </div>
    @endif
    <h5 class="content m-3">Шаг {{ $stepFrame }}/2</h5>
    @if ($stepFrame == 1)
        <section class="content">

            <div class="container-fluid row">
                <div class="col-6">
                    {{-- ? Create a exercise --}}
                    <form action="#" wire:submit.prevent="toStageTwo" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- * Title --}}
                        <div class="form-group">
                            <label for="title">Название задания</label>
                            <input type="text"
                                class="form-control form-control-lg @error('exercise_title') is-invalid @enderror"
                                id="title" wire:model="exercise_title" placeholder="Название">
                            @error('exercise_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- * Exerpt --}}
                        <div class="form-group">
                            <label for="title">Краткое описание</label>
                            <textarea type="text" class="form-control @error('exercise_excerpt') is-invalid @enderror" id="title"
                                wire:model="exercise_excerpt" placeholder="Название"></textarea>
                            @error('exercise_excerpt')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- * Description --}}
                        <div class="form-group" wire:ignore>
                            <label for="title">Описание задания</label>
                            <textarea id="summernote" class="form-control" name="exercise_body" placeholder="Название"></textarea>
                        </div>
                        {{-- * Description error --}}
                        @error('exercise_body')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="row">
                            <span class="text-secondary ml-2 mb-2">После добавления нужно будет добавить ссылки, файлы и видео к данному заданию</span>
                        </div>
                        <div class="row">
                            <input type="submit" class="btn ml-2 btn-primary" value="Создать и продолжить">
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <h2>Предпросмотр задания</h2>
                    <div class="card p-2 exercise-preview">
                        <h1>{{ $exercise_title }}</h1>
                        <div>{!! $exercise_body !!}</d>
                    </div>
                </div>
        </section>
        {{-- * Settings summerNote for this setup --}}
        <script>
            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('exercise_body', contents);
                    }
                }
            });
        </script>
    @elseif ($stepFrame == 2)
        <section class="content ml-3">
            <div class="row">
                {{-- TODO: Addition files to the exercise --}}

                <div class="card p-4 col-sm">


                    <form action="#" wire:submit.prevent="addFileToExercise" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <h5>Добавить файлы к упражнению @if ($exercise)
                                {{ $exercise->title }}
                            @endif
                        </h5>
                        {{-- Some input --}}
                        <div class="form-group">
                            <label for="title">Название сслыки</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" wire:model="title" placeholder="Название">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <input type="submit" class="form-control btn btn-primary m-2" value="Добавить файл">
                        </div>
                    </form>
                </div>

            </div>

            <div class="row">
                {{-- TODO: Addition videos to the exercise --}}
                <div class="card p-4 col-sm">
                    <form action="#" wire:submit.prevent="addVideoToExercise" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <h5>Добавить видео к упражнению @if ($exercise)
                                {{ $exercise->title }}
                            @endif
                        </h5>
                        {{-- Some imput --}}
                        <div class="form-group">
                            <label for="title">Название сслыки</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" wire:model="title" placeholder="Название">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <input type="submit" class="btn btn-primary form-control m-2" value="Создать и продолжить">
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                {{-- ? Addition links to the exercise --}}
                <div class="card p-4 col-sm">
                    <form action="#" wire:submit.prevent="addLinkToExercise" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <h5>Добавить ссылки к упражнению @if ($exercise)
                                {{ $exercise->title }}
                            @endif
                        </h5>
                        <div class="row">
                            {{-- * Link name --}}
                            <div class="form-group col-4">
                                <label for="link_name">Название сслыки </label>
                                <input type="text" class="form-control @error('link_name') is-invalid @enderror"
                                    id="link_name" wire:model="link_name" placeholder="Название">
                                @error('link_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- * URL to link --}}
                            <div class="form-group  col-8">
                                <label for="link_url">url</label>
                                <input type="text" class="form-control @error('link_url') is-invalid @enderror"
                                    id="link_url" wire:model="link_url" placeholder="Название">
                                @error('link_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" class="form-control btn btn-primary m-2" value="Создать cсылку">
                        </div>
                    </form>
                    <hr>
                    {{-- TODO: Привести это в нормальный вид и добавить везде! --}}
                    <div class="row">
                    @forelse ($links as $link)
                        <div class="card col-2">
                            <div class="text">
                                <h5 class="my-0 font-weight-normal">{{ $link->name }}</h5>
                            </div>
                            <div class="card-body row">
                                <a target="_blank" href="{{ $link->url }}" class="btn btn-lg btn-block btn-outline-primary">Перейти</a>
                                <a wire:click="deleteLink({{ $link->id }})" class="btn btn-lg btn-block btn-outline-danger">Удалить</a>
                            </div>
                        </div>
                    @empty
                        <div class="row m-1">
                            <h5> Ссылки пока ещё не добавлены</h5>
                        </div>
                    @endforelse
                </div>
                </div>

            </div>
            <hr>
            <div class="row ">
                <button class="btn btn-primary " wire:click="completeExerciseCreate">Завершить добавление
                    задания</button>
            </div>
        </section>
    @endif
</div>