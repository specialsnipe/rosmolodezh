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

    public $modal_title;
    public $modal_opened = false;
    public $modal_info;
    public $modal_inputs = [];
    public $modal_buttons = [];


    public $modalDataTimeMax;
    public $modal_data_class_name;
    public $modal_data_name;
    public $modal_data_body;

    /**
     *  open modal for change the complexity time
     */
    public function openTimeChangeModal($complexity_time_id)
    {
        $this->target_complexity_time = ComplexityTime::find($complexity_time_id);
        $this->modal_opened = true;
        $this->modal_data_class_name = $this->target_complexity_time->class_name;
        $this->modalDataTimeMax = $this->target_complexity_time->ended_at;

        $this->modal_title = "Изменение интервала ({$this->target_complexity_time->started_at}:{$this->target_complexity_time->ended_at})";
        $this->modal_info = "Вы можете изменить некоторые пункты в этом интервале";
        $this->modal_inputs = [
            [
                'type' => 'number',
                'name' => 'started_at',
                'title' => 'Начало',
                'value' => $this->target_complexity_time->started_at,
            ],
            [
                'type' => 'number',
                'name' => 'ended_at',
                'title' => 'Конец',
                'value' => $this->target_complexity_time->ended_at,
            ],
            [
                'type' => 'select',
                'name' => 'class_name',
                'title' => 'Цвет',
                'value' => $this->target_complexity_time->class_name,
            ]
        ];
        $this->modal_buttons = [
            [
                'name' => 'Cохранить',
                'class_btn' => 'btn-primary'
            ],
        ];

    }

    /**
     *  modal of create a new interval
     */
    public function openTimeCreateModal()
    {
        #
    }
    /**
     *  modal of create a new interval
     */
    public function openDeleteTimeModal(ComplexityTime $complexity_time)
    {
        #
    }

    /**
     *  update the time interval or this color
     */
    public function updateTime($complexity_time_id)
    {

        $currentTime = ComplexityTime::find($complexity_time_id);
        $nextTimeInterval;
        $oldTimeInterval;
        $maybeLastEndedAt = $this->target_complexity_time->ended_at + 1;
        foreach($this->complexity_times as $c_time) {
            if ($maybe_next_started_at == $c_time->started_at) {
                $nextTimeInterval = $c_time;
            }
        }
    }
    /**
     *  create a new time interval
     */
    public function createTime()
    {
        #
    }

    /**
     *  delete the time interval
     */
    public function deleteTime(ComplexityTime $complexity_time)
    {
        #
    }


    /**
     *  open modal for change the complexity
     */
    public function openComplexityChangeModal(Complexity $complexity)
    {
        #
    }

    /**
     *  update the complexity or this color
     */
    public function updateComplexity(Complexity $complexity)
    {
        #
    }

    /**
     *  modal of create a new complexity
     */
    public function openComplexityCreateModal()
    {
        #
    }

    /**
     *  create a new complexity
     */
    public function createComplexity()
    {
        #
    }

    public function closeModal()
    {
        $this->modal_opened = false;
    }

    public function updatedModalDataTimeMax($value)
    {

        $currentTimeIntervalEnd = $this->target_complexity_time->ended_at;
        $currentTimeIntervalStart = $this->target_complexity_time->started_at;
        $nextTimeInterval;
        $oldTimeInterval;
        $maybeLastEndedAt = $this->target_complexity_time->ended_at + 1;
        foreach($this->complexity_times as $c_time) {
            if ($maybe_next_started_at == $c_time->started_at) {
                $nextTimeInterval = $c_time;
            }
        }
        // dd($value <= $nextTimeInterval->ended_at
        // && $value > ($nextTimeInterval->ended_at - 2));
        if ($value <= $nextTimeInterval->ended_at
            && $value > ($nextTimeInterval->ended_at - 2)) {

            $min = $nextTimeInterval->ended_at -1;
            $max = $nextTimeInterval->ended_at;
            session()->flash('errorEndedAt',
            "Заданное значение попадает в интервал - {$min} : {$max}");
            // dd("Заданное значение попадает в интервал - {$min} : {$max}");

        } else if ($value > $nextTimeInterval->ended_at ) {
            // Error message about MAX ДОЛЖНО БЫТЬ МЕНЬШЕ ЧЕМ ^ ПОТОМУ ШО ОНО УЖЕ ТОГО СЕГО И ЭТОГО
            session()->flash('errorEndedAt',
             "Верхнее значение текущего интервала привышает верхнее значение следущего - {$nextTimeInterval->ended_at}" );
        } else if ($value <= $currentTimeIntervalStart) {
            session()->flash('errorEndedAt',
             "Верхнее значение не может быть ниже или равно нижнему значению этого интервала - {$currentTimeIntervalStart}");
        }
    }

    public function mount()
    {
        $this->complexities = Complexity::all();
        $this->complexity_times = ComplexityTime::all();
        $this->colors = [
            'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
        ];
        // dd($this->complexities);
    }

    public function render()
    {
        return view('livewire.admin.settings.complexity.complexity-and-time-manage-component');
    }
}
