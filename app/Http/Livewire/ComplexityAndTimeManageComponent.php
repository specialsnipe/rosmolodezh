<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Complexity;
use App\Models\ComplexityTime;

class ComplexityAndTimeManageComponent extends Component
{
    public $colors;
    public $complexities;
    public $complexity_times;
    public $target_complexity_time;
    public $targetComplexityId;

    public $modal_title;
    public $modal_opened = false;
    public $modal_isCreateNewInterval = false;
    public $modal_info;
    public $modal_inputs = [];
    public $modal_buttons = [];


    public $modalDataTimeMax;
    public $modalDataClassName;
    public $modalDataName;
    public $modalDataLevel;
    public $modalDataBody;



    /**
     *  open modal for change the complexity time
     */
    public function openTimeChangeModal($complexityTimeId)
    {
        $targetComplexityTime = ComplexityTime::find($complexityTimeId);
        $this->target_complexity_time = $targetComplexityTime;
        $this->modalDataClassName = $targetComplexityTime->class_name;
        $this->modalDataTimeMax = $targetComplexityTime->ended_at;

        $this->modal_opened = true;
        $this->modal_title = "Изменение интервала ({$targetComplexityTime->started_at}:{$targetComplexityTime->ended_at})";
        $this->modal_info = "Вы можете изменить некоторые пункты в этом интервале.<br>
        При изменении верхней границы данного интервала - нижняя граница следущего интервала автоматически изменяется в пользу этого интервала.";
        $this->modal_inputs = [
            [
                'type' => 'number',
                'name' => 'started_at',
                'title' => 'Начало',
                'value' => $targetComplexityTime->started_at,
            ],
            [
                'type' => 'number',
                'name' => 'ended_at',
                'wire_model' => 'modalDataTimeMax',
                'title' => 'Конец',
                'value' => $targetComplexityTime->ended_at,
            ],
            [
                'type' => 'select',
                'name' => 'class_name',
                'wire_model' => 'modalDataClassName',
                'title' => 'Цвет',
                'value' => $targetComplexityTime->class_name,
            ]
        ];
        $this->modal_buttons = [
            [
                'name' => 'Cохранить',
                'class_btn' => 'btn-primary',
                'action' => "updateTime({$complexityTimeId})"
            ],
        ];
    }

    /**
     *  modal of create a new interval
     */
    public function openTimeCreateModal()
    {
        $lastComplexityTime = ComplexityTime::all()->sortByDesc('ended_at')->first();
        $this->modal_isCreateNewInterval = true;
        $this->modalDataClassName = 'primary';


        if (isset($lastComplexityTime)) {
            $this->modalDataTimeMax = $lastComplexityTime->ended_at + 2;
            $this->modal_opened = true;
            $this->modal_title = "Создание нового интервала";
            $this->modal_info = "Вы можете создать новый интервал, но он будет обязательно начинаться с того момента когда заканчивается последний.";
            $this->modal_inputs = [
                [
                    'type' => 'number',
                    'name' => 'started_at',
                    'title' => 'Начало',
                    'value' => $lastComplexityTime->ended_at + 1,
                ],
                [
                    'type' => 'number',
                    'name' => 'ended_at',
                    'wire_model' => 'modalDataTimeMax',
                    'title' => 'Конец',
                    'value' => $lastComplexityTime->ended_at + 1,
                ],
                [
                    'type' => 'select',
                    'name' => 'class_name',
                    'title' => 'Цвет',
                    'value' => '',
                ]
            ];
            $this->modal_buttons = [
                [
                    'name' => 'Сохранить',
                    'class_btn' => 'btn-primary',
                    'action' => "createTime"
                ],
            ];
        } else {
            // dd('sdspds');
            $this->modal_opened = true;
            $this->modalDataTimeMax = 0;
            $this->modal_title = "Создание нового интервала";
            $this->modal_info = "Вы можете создать новый интервал, но он будет обязательно начинаться с того момента когда заканчивается последний.";
            $this->modal_inputs = [
                [
                    'type' => 'number',
                    'name' => 'started_at',
                    'title' => 'Начало',
                    'value' => 0,
                ],
                [
                    'type' => 'number',
                    'name' => 'ended_at',
                    'wire_model' => 'modalDataTimeMax',
                    'title' => 'Конец',
                    'value' => 0,
                ],
                [
                    'type' => 'select',
                    'name' => 'class_name',
                    'title' => 'Цвет',
                    'value' => '',
                ]
            ];
            $this->modal_buttons = [
                [
                    'name' => 'Сохранить',
                    'class_btn' => 'btn-primary',
                    'action' => "createTime"
                ],
            ];
        }
    }
    /**
     *  modal of create a new interval
     */
    public function openDeleteTimeModal($complexityTimeId)
    {
        $targetComplexityTime = ComplexityTime::find($complexityTimeId);
        // dd('оло');
        $this->modal_opened = true;
        $this->modal_title = "Удаление интервала ({$targetComplexityTime->started_at}:{$targetComplexityTime->ended_at})";
        $this->modal_info = "При удалении данного интервала предыдущий интервал обновиться, и его верхняя гранится будет равна верхней границе данного интервала.
        <br> Вы уверены что ходите удалить данный интервал?";
        $this->modal_inputs = [];
        $this->modal_buttons = [
            [
                'name' => 'Удалить',
                'class_btn' => 'btn-danger',
                'action' => "deleteTime({$complexityTimeId})"
            ],
        ];
    }

    /**
     *  update the time interval or this color
     */
    public function updateTime($complexity_time_id)
    {
        $currentTimeInterval = ComplexityTime::find($complexity_time_id);
        $this->target_complexity_time = $currentTimeInterval;
        $nextTimeInterval;
        $oldTimeInterval;
        $maybeNextStartedAt = $this->target_complexity_time->ended_at + 1;

        foreach ($this->complexity_times as $complexity_time) {
            if ($maybeNextStartedAt == $complexity_time->started_at) {
                $nextTimeInterval = $complexity_time;
                $currentTimeInterval->update([
                    'ended_at' => $this->modalDataTimeMax,
                    'class_name' => $this->modalDataClassName,
                ]);
                $nextTimeInterval->update([
                    'started_at' => $currentTimeInterval->ended_at + 1,
                ]);
            }
        }

        if (!isset($nextTimeInterval)) {
            $currentTimeInterval->update([
                'ended_at' => $this->modalDataTimeMax,
                'class_name' => $this->modalDataClassName,
            ]);
        }

        $this->complexity_times = ComplexityTime::all()->sortBy('started_at');
        $this->modal_opened = false;
    }
    /**
     *  create a new time interval
     */
    public function createTime()
    {
        $lastComplexityTime = ComplexityTime::all()->sortByDesc('ended_at')->first();
        $this->modal_isCreateNewInterval = false;

        if (isset($lastComplexityTime)) {
            ComplexityTime::create([
                'started_at' => $lastComplexityTime->ended_at + 1,
                'ended_at' => $this->modalDataTimeMax,
                'class_name' => $this->modalDataClassName
            ]);
        } else {
            ComplexityTime::create([
                'started_at' => 0,
                'ended_at' => $this->modalDataTimeMax,
                'class_name' => $this->modalDataClassName
            ]);
        }

        $this->complexity_times = ComplexityTime::all()->sortBy('started_at');
        $this->modal_opened = false;
    }

    /**
     *  delete the time interval
     */
    public function deleteTime($complexityId)
    {
        $complexityTime = ComplexityTime::find($complexityId);
        $complexityTimeBeforeCurrent = ComplexityTime::where('ended_at', $complexityTime->started_at - 1)->first();
        $complexityTimeAfterCurrent = ComplexityTime::where('started_at', $complexityTime->ended_at + 1)->first();

        if (isset($complexityTimeAfterCurrent)) {
            if (isset($complexityTimeBeforeCurrent)) {
                $complexityTimeBeforeCurrent->update([
                    'ended_at' => $complexityTime->ended_at
                ]);
            } else {
                $complexityTimeAfterCurrent->update([
                    'started_at' => $complexityTime->started_at
                ]);
            }
        }

        $complexityTime->delete();
        $this->complexity_times = ComplexityTime::all()->sortBy('started_at');
        return redirect()->route('admin.settings.complexity.index');
        // dd($this->complexity_times, ComplexityTime::all()->sortBy('started_at'));
    }

    /**
     *  open modal for change the complexity
     */
    public function openComplexityDeleteModal($complexity_id)
    {
        $complexity = Complexity::find($complexity_id);
        $this->modal_opened = true;
        $this->modal_title = "Удаление сложности ({$complexity->name})";
        $this->modal_info = "Вы уверены что хоnите удалить данную сложность?";
        $this->modal_inputs = [];
        $this->modal_buttons = [
            [
                'name' => 'Удалить',
                'class_btn' => 'btn-danger',
                'action' => "deleteComplexity({$complexity_id})"
            ],
        ];
    }

    public function deleteComplexity($complexity_id)
    {
        $this->modal_opened = false;

        $complexity = Complexity::find($complexity_id)->delete();

        return redirect()->route('admin.settings.complexity.index');
    }

    /**
     *  open modal for change the complexity
     */
    public function openComplexityChangeModal(Complexity $complexity)
    {
        $this->targetComplexityId = $complexity->id;
        $this->modalDataName = $complexity->name;
        $this->modalDataLevel = $complexity->level;
        $this->modalDataClassName = $complexity->class_name;
        $this->modalDataBody = $complexity->body;
        $this->modal_opened = true;
        $this->modal_title = "Изменение сложности ({$complexity->name})";
        $this->modal_info = "Вы можете изменить данную сложность, все задания с этой сложностью останутся рабочими.";
        $this->modal_inputs = [
            [
                'type' => 'text',
                'name' => 'name',
                'wire_model' => 'modalDataName',
                'title' => 'Название <sup class="text-muted">(Нормально)</sup>',
                'value' => '',
            ],
            [
                'type' => 'text',
                'name' => 'level',
                'wire_model' => 'modalDataLevel',
                'title' => 'Название уровня <sup class="text-muted">(Нормальный)</sup>',
                'value' => '',
            ],
            [
                'type' => 'select',
                'name' => 'class_name',
                'size' => 'col-12',
                'wire_model' => 'modalDataClassName',
                'title' => 'Цвет',
                'value' => '',
            ],
            [
                'type' => 'text',
                'name' => 'body',
                'size' => 'col-12',
                'wire_model' => 'modalDataBody',
                'title' => 'Описание',
                'value' => '',
            ]
        ];
        $this->modal_buttons = [
            [
                'name' => 'Сохранить',
                'class_btn' => 'btn-primary',
                'action' => "updateComplexity({$complexity->id})"
            ],
        ];
    }


    /**
     *  update the complexity or this color
     */
    public function updateComplexity(Complexity $complexity)
    {
        $data = $this->validate([
            'modalDataName' => ['required', 'unique:complexities,name,' . $complexity->id],
            'modalDataLevel' => ['required', 'unique:complexities,level,' . $complexity->id],
        ],[
            'modalDataName.required' => 'Обязательно напишите название.',
            'modalDataName.unique' => 'Сложность с таким названием уже существует.',
            'modalDataLevel.required' => 'Обязательно напишите уровень.',
            'modalDataLevel.unique' => 'Сложность с таким уровнем уже существует.',
        ]);
        if ($data) {
            $complexity->update([
                'name' => $this->modalDataName ,
                'level' => $this->modalDataLevel ,
                'class_name' => $this->modalDataClassName ,
                'body' => $this->modalDataBody,
            ]);

            $this->targetComplexityId = false;
            $this->complexities = Complexity::all();
            $this->modal_opened = false;
        } else {
            $this->addError('modalError', 'Исправьте все ошибки перед тем как сохранить изменения');
        }
    }

    /**
     *  modal of create a new complexity
     */
    public function openComplexityCreateModal()
    {
        $this->modal_opened = true;
        $this->modalDataName = '';
        $this->modalDataLevel = '';
        $this->modalDataClassName = 'primary';
        $this->modalDataBody = '';

        $this->modal_title = "Создание новой сложности";
        $this->modal_info = "Вы можете создать новую сложность, которую можно будет использовать при создании задания.";
        $this->modal_inputs = [
            [
                'type' => 'text',
                'name' => 'name',
                'wire_model' => 'modalDataName',
                'title' => 'Название <sup class="text-muted">(Нормально)</sup>',
                'value' => '',
            ],
            [
                'type' => 'text',
                'name' => 'level',
                'wire_model' => 'modalDataLevel',
                'title' => 'Название уровня <sup class="text-muted">(Нормальный)</sup>',
                'value' => '',
            ],
            [
                'type' => 'select',
                'name' => 'class_name',
                'size' => 'col-12',
                'wire_model' => 'modalDataName',
                'title' => 'Цвет',
                'value' => '',
            ],
            [
                'type' => 'text',
                'name' => 'body',
                'size' => 'col-12',
                'wire_model' => 'modalDataBody',
                'title' => 'Описание',
                'value' => '',
            ]
        ];
        $this->modal_buttons = [
            [
                'name' => 'Сохранить',
                'class_btn' => 'btn-primary',
                'action' => "createComplexity"
            ],
        ];
    }

    /**
     *  create a new complexity
     */
    public function createComplexity()
    {
        // dd($this->modalDataClassName);
        $validatedData = $this->validate([
            'modalDataName' => ['required', 'unique:complexities,name'],
            'modalDataLevel' => ['required', 'unique:complexities,level'],
        ],[
            'modalDataName.required' => 'Обязательно напишите название.',
            'modalDataName.unique' => 'Сложность с таким названием уже существует.',
            'modalDataLevel.required' => 'Обязательно напишите уровень.',
            'modalDataLevel.unique' => 'Сложность с таким уровнем уже существует.',
        ]);

        if ($validatedData) {
            Complexity::create([
                'class_name' => $this->modalDataClassName,
                'name'=>$this->modalDataName,
                'level'=>$this->modalDataLevel,
                'body'=>$this->modalDataBody,
            ]);

            $this->complexities = Complexity::all();
            $this->modal_opened = false;
        } else {
            $this->addError('modalError', 'Исправьте ошибки перед тем как сохранять!');
        }
    }

    public function closeModal()
    {
        $this->modal_opened = false;
        $this->modal_isCreateNewInterval = false;
    }


    /**
     * Validate data time interval
     *
     */
    public function updatedModalDataTimeMax($value)
    {
        if ($this->modal_isCreateNewInterval) {
            $lastComplexityTime = ComplexityTime::all()->sortByDesc('ended_at')->first();
            if (isset($lastComplexityTime)) {
                $lastTimeIntervalEnd = $lastComplexityTime->ended_at;
                if ($lastTimeIntervalEnd >= $value) {
                    $this->addError('modalDataTimeMax', "Верхнее значение не может быть ниже или равно окончанию последнего интервала - {$lastTimeIntervalEnd}");
                } else {
                    $this->resetErrorBag('modalDataTimeMax');
                }
            }
        } else {
            $currentTimeIntervalEnd = $this->target_complexity_time->ended_at;
            $currentTimeIntervalStart = $this->target_complexity_time->started_at;
            $nextTimeInterval;
            $maybeNextStartedAt = $this->target_complexity_time->ended_at + 1;

            foreach ($this->complexity_times as $complexityTime) {
                if ($maybeNextStartedAt == $complexityTime->started_at) {
                    $nextTimeInterval = $complexityTime;
                }
            }

            if (!isset($nextTimeInterval)) {
                if ($value <= $currentTimeIntervalStart) {
                    $this->addError(
                        'modalDataTimeMax',
                        "Верхнее значение не может быть ниже или равно окончанию последнего интервала - {$lastTimeIntervalEnd}"
                    );
                } else {
                    $this->resetErrorBag('modalDataTimeMax');
                }
            } else {
                if ($value <= $nextTimeInterval->ended_at &&
                    $value > ($nextTimeInterval->ended_at - 2)) {
                    $min = $nextTimeInterval->ended_at -1;
                    $max = $nextTimeInterval->ended_at;
                    $this->addError(
                        'modalDataTimeMax',
                        "Заданное значение попадает в интервал - {$min} : {$max}"
                    );
                } elseif ($value > $nextTimeInterval->ended_at) {

                    // Error message about max more then ended at next interval
                    $this->addError(
                        'modalDataTimeMax',
                        "Верхнее значение текущего интервала привышает верхнее значение следущего - {$nextTimeInterval->ended_at}"
                    );
                } elseif ($value <= $currentTimeIntervalStart) {
                    $this->addError(
                        'modalDataTimeMax',
                        "Верхнее значение не может быть ниже или равно нижнему значению этого интервала - {$currentTimeIntervalStart}"
                    );
                } else {
                    $this->resetErrorBag('modalDataTimeMax');
                }
            }
        }
    }

    /**
     * Validate data name of new complexity
     *
     */
    public function updatedModalDataName($value)
    {
        if ($this->targetComplexityId) {
            $this->validate([
                'modalDataName' => ['required', 'unique:complexities,name,' . $this->targetComplexityId],
                'modalDataLevel' => ['required', 'unique:complexities,level,' . $this->targetComplexityId],
            ],[
                'modalDataName.required' => 'Обязательно напишите название.',
                'modalDataName.unique' => 'Сложность с таким названием уже существует.',
                'modalDataLevel.required' => 'Обязательно напишите уровень.',
                'modalDataLevel.unique' => 'Сложность с таким уровнем уже существует.',
            ]);
        } else {
            $this->validate([
                'modalDataName' => ['required', 'unique:complexities,name'],
                'modalDataLevel' => ['required', 'unique:complexities,level'],
            ],[
                'modalDataName.required' => 'Обязательно напишите название.',
                'modalDataName.unique' => 'Сложность с таким названием уже существует.',
                'modalDataLevel.required' => 'Обязательно напишите уровень.',
                'modalDataLevel.unique' => 'Сложность с таким уровнем уже существует.',
            ]);
        }
    }
    public function updatedModalDataLevel($value)
    {
        if ($this->targetComplexityId) {
            $this->validate([
                'modalDataName' => ['required', 'unique:complexities,name,' .$this->targetComplexityId],
                'modalDataLevel' => ['required', 'unique:complexities,level,' . $this->targetComplexityId],
            ],[
                'modalDataName.required' => 'Обязательно напишите название.',
                'modalDataName.unique' => 'Сложность с таким названием уже существует.',
                'modalDataLevel.required' => 'Обязательно напишите уровень.',
                'modalDataLevel.unique' => 'Сложность с таким уровнем уже существует.',
            ]);
        } else {
            $this->validate([
                'modalDataName' => ['required', 'unique:complexities,name'],
                'modalDataLevel' => ['required', 'unique:complexities,level'],
            ],[
                'modalDataName.required' => 'Обязательно напишите название.',
                'modalDataName.unique' => 'Сложность с таким названием уже существует.',
                'modalDataLevel.required' => 'Обязательно напишите уровень.',
                'modalDataLevel.unique' => 'Сложность с таким уровнем уже существует.',
            ]);
        }
    }

    public function mount()
    {
        $this->complexities = Complexity::all();
        $this->complexity_times = ComplexityTime::all()->sortBy('started_at');
        $this->colors = [
            'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
        ];
    }

    public function render()
    {
        return view('livewire.admin.settings.complexity.complexity-and-time-manage-component');
    }
}
