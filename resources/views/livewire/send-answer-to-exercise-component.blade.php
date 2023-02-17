<div class="card">
    <div class="card-body">
        <div class="text-h1">Отправить ответ на задание</div>
        <form action="#" wire:submit.prevent='saveAnswer'>
            <div class="row">
                <div class="col-sm-12" wire:ignore>
                    <textarea id="summernote" name="body" > </textarea>
                </div>
                <div class="col-sm-12 mb-4" >
                    @error('body')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <script>
                    $(document).ready(function (params) {

                        $('#summernote').summernote({
                                tabsize: 2,
                                height: 150,
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
                                        @this.set('body', contents);
                                    }
                                }
                            });
                        $('#summernote').summernote('pasteHTML', @js($bodyDefault))
                    });
                </script>
                <div class="col-sm-12 col-md-8 ">
                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <input type="file" name="file" class="form-control w-100 @error('file') is-invalid @enderror" wire:model='file'>
                        @error('file')
                            <span class='text-danger'> {{ $message }}</span>
                        @enderror
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <button type="button" name="file" class="btn btn-primary w-100" wire:click='uploadFile'> Добавить
                        файл </button>
                </div>
                @if(!empty($files))

                <div class="col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Добавленные файлы
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($files as $file)
                                <div class="col-sm-12 col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <p> {{ $file->original_file_name }}</p>
                                            <p> {{ $file->file_size }} КБ.</p>
                                            <button type="button" class="btn btn-danger"
                                                wire:click='deleteFile({{ $file->id }})'> Удалить файл</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                @endif
                <div class="col-sm-12 d-flex align-items-center justify-content-between">
                    <div class="col-sm-12 col-md-9">
                        <span class="text-muted"> *Не переживайте, если случайно выйдете с этого упражнения, вы в любой
                            момент сможете дополнить или изменить свой ответ</span>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <button type="submit" class="btn btn-primary ml-3 w-100"> Сохранить ответ</button>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-danger" wire:click="toggleModalDelete"> Выйти без сохранения</button>
                </div>

            </div>
        </form>
        <style>
            .modal-window {
                position: fixed;
                top:0;
                left:0;
                width: 100%;
                height: 100%;
                background: hsl(0 0% 0% / 0.2);
                z-index: 1;
            }
            .modal-block {
                position: fixed;
                top:50%;
                left:50%;
                transform: translate(-50%, -50%);
                z-index: 2;
            }
        </style>
        @if($modalDeleteAnswer)
            <div class="modal-window" wire:click="toggleModalDelete"></div>
            <div class="modal-block card">
                <div class="card-header">
                    <span class="fs-5 d-flex justify-content-between align-items-center">
                        Вы уверены что хотите выйти без сохранения?
                        <i class="fa fa-times text-danger" wire:click="toggleModalDelete"
                            style="cursor: pointer;"></i>
                    </span>
                </div>
                <div class="card-body">
                    <p>Если вы выйдите из этой страницы таким образом, то ваш ответ будет навсегда удалён!</p>
                    <hr >
                    <div class="d-flex justify-content-between align-items-center">
                        Вы уверены?
                        <div class="btn btn-danger" wire:click="outWithoutSave"> Удалить</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
