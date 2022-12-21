<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\aboutAdvantage\StoreAboutAdvantageRequest;
use App\Http\Requests\aboutAdvantage\StoreAboutGrantRequest;
use App\Http\Requests\aboutAdvantage\UpdateAboutAdvantageRequest;
use App\Http\Requests\aboutAdvantage\UpdateAboutGrantRequest;
use App\Models\AboutAdvantageItem;
use App\Models\Partnership;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnershipRequest;
use App\Http\Requests\UpdatePartnershipRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AboutAdvantageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $partnership = Partnership::first();
//        return view('admin.settings.partnership.index', compact('partnership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnershipRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreAboutAdvantageRequest $request)
    {
        $data = $request->validated();
        $data['about_id'] = 1;
        AboutAdvantageItem::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function show(Partnership $partnership)
    {
        //
    }


    /**
     * @param Partnership $partnership
     * @return Application|Factory|View
     */
    public function edit(Partnership $partnership)
    {
//        return view('admin.settings.partnership.edit', compact('partnership'));
    }


    /**
     * @param UpdateAboutAdvantageRequest $request
     * @param AboutAdvantageItem $aboutAdvantageItem
     * @return RedirectResponse
     */
    public function update(UpdateAboutAdvantageRequest $request, $aboutAdvantageItem)
    {
        $data = $request->validated();
        $aboutAdvantageItem = AboutAdvantageItem::find($aboutAdvantageItem);
        try{
            $aboutAdvantageItem->update($data);
            return back()
                ->with('success_advantage', 'Данные успешно обновлены');
        }catch (\Exception $e){
            return back()
                ->with('error_advantage', 'Что-то пошло не так');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partnership  $partnership
     * @return RedirectResponse
     */
    public function destroy(Request $request, $advantageItem)
    {
        $aboutAdvantageItem = AboutAdvantageItem::find($advantageItem);
        if (!Hash::check($request->input('password'), auth()->user()->password)) {
            session()->flash('error', 'При удалении вы ввели неверный пароль, попробуйте снова');
            return back();
        }
        try {
            $aboutAdvantageItem->deleteOrFail();
            return back()
                ->with('success_advantage', 'Данные успешно обновлены');
        } catch (\Exception $exception) {
            abort(501);
        }
    }
}
