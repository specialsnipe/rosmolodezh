<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Slider\StoreSliderRequest;
use App\Models\SliderItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Services\ImageService;

class SliderController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $slides = SliderItem::latest()->get();
        return view('admin.settings.slider.index', compact('slides'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.settings.slider.create');
    }


    public function store(StoreSliderRequest $request)
    {
        $data = $request->validated();
        $file = $data['image'];
        $filename = ImageService::make($file, 'slider/images', false);
        $data['image'] = $filename;
        $data['user_id'] = auth()->user()->id;
        SliderItem::create($data);
        return redirect()
            ->route('admin.settings.slider.create')
            ->with(['success'=> 'Слайд успешно сохранен']);
    }


    /**
     * @param SliderItem $slider
     * @return void
     */
    public function show(SliderItem $slider)
    {
        //
    }


    /**
     * @param SliderItem $slider
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(SliderItem $slider)
    {
        return view('admin.settings.slider.edit', compact('slider'));
    }



    public function update(UpdateSliderRequest $request, SliderItem $slider)
    {

        $data = $request->validated();

        if(isset($data['image'])) {
            ImageService::deleteOld($slider->image, 'slider/images');
            $filename = ImageService::make($data['image'], 'slider/images', false);
            $data['image'] = $filename;
        }
        $data['user_id'] = auth()->user()->id;
        $slider->updateOrFail($data);
        return redirect()
            ->route('admin.settings.slider.edit', $slider->id)
            ->with(['success'=> 'Слайд успешно изменен']);

    }


    /**
     * @param SliderItem $slider
     * @return void
     */
    public function destroy(SliderItem $slider)
    {
        //
    }
}
