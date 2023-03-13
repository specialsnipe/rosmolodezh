<div>
    @php use App\Models\Complexity; @endphp

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
    @endif
    @if (session()->has('info'))
        <div class="alert alert-info alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('info') }}
        </div>
    @endif

    <div class=" w-100 content d-flex justify-content-between align-items-center mb-3">
        <div class="h5">
            Создание нового упражнения к блоку "{{ $block->title }}" | Шаг
            <span class="badge bg-primary">
                {{ $stepFrame }}/2
            </span>
        </div>
        <a href="{{ route('profile.tracks.blocks.show', [$block->track->slug, $block->slug]) }}"
           class="btn btn-secondary"
        >
            Назад >
        </a>
    </div>

    @if ($stepFrame == 1)
        <section class="row">
            <div class="col-sm-12 col-lg-6">
                {{-- ? Create a exercise --}}
                <form action="#" wire:submit.prevent="toStageTwo" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- * Title --}}
                    <div class="form-group">
                        <label for="title">Название задания <span class="text-secondary">(Это название появится на карточке
                            задания)</span></label>
                        <input type="text"
                               class="form-control form-control-lg @error('exercise_title') is-invalid @enderror" id="title"
                               wire:model="exercise_title" placeholder="Название">
                        @error('exercise_title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- * Exerpt --}}
                    <div class="form-group">
                        <label for="title">Краткое описание <span class="text-secondary">(Это описание появится на карточке
                            задания)</span></label>
                        <textarea type="text" class="form-control @error('exercise_excerpt') is-invalid @enderror"
                                  id="title" wire:model="exercise_excerpt" placeholder="Название"></textarea>
                        @error('exercise_excerpt')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- * Description --}}
                    <div class="form-group mb-3" wire:ignore>
                        <label for="title">Описание задания</label>
                        <textarea id="summernote" class="form-control" name="exercise_body" wire:model="exercise_body"
                                  placeholder="Название">{!! $exercise_body !!}</textarea>
                    </div>
                    {{-- * Description error --}}
                    @error('exercise_body')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    {{-- * Level complexity and time for complete--}}
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="mb-4" for="complexity_id">Сложность задания для учеников</label>
                            <select type="" class="form-control @error('complexity_id') is-invalid @enderror" id="title"
                                    wire:model="complexity_id">
                                @foreach ($complexities as $level)
                                    <option value="{{ $level->id }}"> {{ $level->level }}</option>
                                @endforeach
                            </select>
                            @error('complexity_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="exercise_time">Время для выполнения задания <span class="text-secondary">(в
                                минутах)</span></label>
                            <input type="number" class="form-control @error('exercise_time') is-invalid @enderror"
                                   id="title" wire:model="exercise_time">
                            @error('exercise_time')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                    <span class="text-secondary ml-2 mb-2">После добавления нужно будет добавить ссылки, файлы и видео к
                        данному заданию</span>
                    </div>
                    <div class="row">
                        <input type="submit" class="btn ml-2 btn-primary" value="Обновить и продолжить">
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-lg-6 mt-sm-4 mt-0">
                <h2>Предпросмотр задания</h2>
                <div class="card p-2 exercise-preview" style="max-height: 600px !important;
                                                        overflow: auto;">
                    <h1>{{ $exercise_title }}</h1>

                    <div class="exercise-previev_info">
                        <p style=""> {{ $exercise_excerpt }}</p>
                        <table>
                            @if($complexity_id != '')
                                <tr>
                                    <td>Сложность выполнения:</td>
                                    <td>
                                        <h5><span
                                                class="badge bg-{{ $complexities->where('id', $complexity_id)->first()->class_name }}">
                                        {{ $levels[$complexity_id] }} </span></h5>
                                    </td>
                                </tr>
                            @endif
                            @if($exercise_time != '')
                                <tr>
                                    <td>Время на выполнение:</td>
                                    <td>
                                        <h5>
                                    <span class="badge bg-{{ $complexity_times
                                        ->where('started_at','<=', $exercise_time)
                                        ->where('ended_at','>=', $exercise_time)
                                        ->first() ?$complexity_times
                                                                ->where('started_at','<=', $exercise_time)
                                                                ->where('ended_at','>=', $exercise_time)
                                                                ->first()->class_name : 'light'
                                                                 }}
                                            "> {{ $exercise_time }} минут </span>
                                        </h5>
                                    </td>
                                </tr>
                            @endif
                        </table>
                        <hr>
                    </div>
                    <div>{!! $exercise_body !!}</d>
                    </div>
                </div>
            </div>
        </section>
        {{-- * Settings summerNote for this setup --}}
        <script defer>
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
        <section class="row">
            {{-- TODO: Addition files to the exercise --}}

            <div class="card p-4 col-sm">


                <form action="#" wire:submit.prevent="addFileToExercise" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5>Добавить файлы к упражнению @if ($exercise)
                            {{ $exercise->title }}
                        @endif
                    </h5>
                    {{-- Some input --}}
                    <div class="form-group">
                        <label for="file_title">Название файла (показывается при возможности скачать)</label>
                        <input type="text" class="form-control @error('file_title') is-invalid @enderror" id="file_title"
                               wire:model="file_title">
                        @error('file_title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file_body">Описание файла</label>
                        <textarea type="text" class="form-control @error('file_body') is-invalid @enderror" id="file_body"
                                  wire:model="file_body"> </textarea>
                        @error('file_body')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Добавить файл</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                               wire:model="file" value="{{ $file }}">
                        @error('file')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary mt-3" value="Добавить файл">
                    </div>
                </form>
                <hr>
                {{-- show links of this exercise --}}
                <div class="row">
                    @forelse ($exercise_files as $file)
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card ">

                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="text">
                                            <h5 class="my-0 font-weight-normal ml-3">{{ $file->title }}.{{ $file->file_type }}</h5>
                                            <p class="">Расширение файла: {{ $file->file_type }}</p>
                                            <p class="">Размер файла: {{ $file->file_size }} килобайт.</p>
                                            <a wire:click="deleteFile({{ $file->id }})"
                                               class="btn btn-danger  w-100">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-sm-12">
                            <h5> Файлы пока ещё не добавлены</h5>
                        </div>
                    @endforelse
                </div>
            </div>

        </section>

        <div class="row mt-4">
            {{-- ? Addition links to the exercise --}}
            <div class="card p-4 col-sm">

                {{-- add link form --}}
                <form action="#" wire:submit.prevent="addLinkToExercise" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5>Добавить ссылки к упражнению @if ($exercise)
                            {{ $exercise->title }}
                        @endif
                    </h5>
                    <div class="row">
                        {{-- * Link name --}}
                        <div class="form-group col-sm-12 col-md-4 m-0">
                            <label for="link_name">Название ссылки </label>
                            <input type="text" class="form-control @error('link_name') is-invalid @enderror" id="link_name"
                                   wire:model="link_name" placeholder="Название">
                            @error('link_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- * URL to link --}}
                        <div class="form-group col-sm-12 col-md-8 m-0">
                            <label for="link_url">url</label>
                            <input type="text" class="form-control @error('link_url') is-invalid @enderror" id="link_url"
                                   wire:model="link_url" placeholder="Название">
                            @error('link_url')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-primary mt-3 w-100" value="Создать cсылку">
                        </div>
                    </div>
                </form>
                <hr>
                {{-- show links of this exercise --}}
                <div class="row">
                    @forelse ($links as $link)
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <div class="card">

                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="text">
                                            <h5 class="my-0 font-weight-normal ml-3">{{ $link->name }}</h5>

                                            <a target="_blank" href="{{ $link->url }}" class="btn btn-primary w-100">Перейти</a>
                                            <a wire:click="deleteLink({{ $link->id }})" class="btn btn-danger w-100">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-sm-12">
                            <h5> Ссылки пока ещё не добавлены</h5>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
        <hr>
        <div class="row ">
            <button class="btn btn-primary " wire:click="completeExerciseEdit">Завершить добавление
                задания</button>
        </div>
        </section>
    @endif
</div>
