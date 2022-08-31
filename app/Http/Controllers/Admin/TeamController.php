<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;
use App\Models\Team;
use App\Services\ImageService;

class TeamController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $team = Team::all();
        return view('admin.settings.team.index', compact('team'));
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.settings.team.create');
    }


    /**
     * @param StoreTeamRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTeamRequest $request)
    {
        $data = $request->validated();
        $filename = ImageService::make($request->file('file'), 'team/avatars');
        unset($data['file']);
        $data['avatar'] = $filename;
        Team::firstOrCreate($data);
        return redirect()
            ->route('admin.settings.team.create')
            ->with(['success' => 'Запись успешно создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }


    /**
     * @param Team $team
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Team $team)
    {
        $person = $team;
        return view('admin.settings.team.edit', compact('person'));
    }


    /**
     * @param UpdateTeamRequest $request
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $data = $request->validated();

        if (isset($data['file'])) {
            $filename = ImageService::make($request->file('file'), 'team/avatars');
            unset($data['file']);
            $data['avatar'] = $filename;
        }

        $result = $team->updateOrFail($data);
        if ($result) {
            return redirect()
                ->route('admin.settings.team.edit', $team->id)
                ->with(['success' => 'Успешно изменено']);
        } else {
            return back()
                ->withErrors(['error' => 'Ошибка обновления'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
