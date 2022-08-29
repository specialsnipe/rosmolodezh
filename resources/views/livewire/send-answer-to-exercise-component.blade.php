<div class="card">
    <div class="card-body">
        <div class="text-h1">Отправить ответ на задание</div>
        <form action="" wire:submit.prevent='saveAnswer'>
            <div class="row">
                <div class="col-sm-12" wire:ignore>
                    <textarea id="summernote" name="body" wire:model="body"> </textarea>
                </div>
                <div class="col-sm-12 mb-4" wire:ignore>
                    @error('body')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <script defer>
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
                </script>
                <div class="col-sm-12 col-md-8 ">
                    <input type="file" name="file" class="form-control w-100 @error('file') is-invalid @enderror" wire:model='file'>
                    @error('file')
                        <span class='text-danger'> {{ $message }}</span>
                    @enderror
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
                            момент сможете его добавить и изменить </span>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <button type="submit" class="btn btn-primary ml-3 w-100"> Сохранить ответ</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
