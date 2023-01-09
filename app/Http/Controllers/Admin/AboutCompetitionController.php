<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutCompetition\StoreAboutCompetitionRequest;
use App\Http\Requests\AboutCompetition\UpdateAboutCompetitionRequest;
use App\Models\AboutCompetitionItem;
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

class AboutCompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreAboutCompetitionRequest $request)
    {
        $data = $request->validated();
        $data['about_id'] = 1;
        AboutCompetitionItem::create($data);
        return back()
            ->with('success', 'Данные успешно сохранены');;
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
        //
    }


    /**
     * @param UpdatePartnershipRequest $request
     * @param Partnership $partnership
     * @return RedirectResponse
     */
    public function update(UpdateAboutCompetitionRequest $request, $aboutCompetitionItem)
    {
        $data = $request->validated();
        $aboutCompetitionItem = AboutCompetitionItem::find($aboutCompetitionItem);
        try{
            $aboutCompetitionItem->update($data);
            return back()
                ->with('success', 'Данные успешно обновлены');
        }catch (\Exception $e){
            return back()
                ->with('error', 'Что-то пошло не так');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partnership  $partnership
     * @return RedirectResponse
     */
    public function destroy(Request $request, $competitionItem)
    {
        $aboutCompetitionItem = AboutCompetitionItem::find($competitionItem);
        if (!Hash::check($request->input('password'), auth()->user()->password)) {
            session()->flash('error', 'При удалении вы ввели неверный пароль, попробуйте снова');
            return back();
        }
        try {
            $aboutCompetitionItem->deleteOrFail();
            return back()
                ->with('success', 'Данные успешно обновлены');
        } catch (\Exception $exception) {
            abort(501);
        }
    }
}
