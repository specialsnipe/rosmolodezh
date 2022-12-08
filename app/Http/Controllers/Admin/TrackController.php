<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Track\StoreTrackRequest;
use App\Http\Requests\Track\UpdateTrackRequest;
use App\Models\Admin\Track;
use App\Models\Admin\User;
use App\Services\AverageMark\AverageMarkTrack;
use App\Services\ImageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TrackController extends Controller
{
    /**
     * Display a listing of the tracks.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $tracks = Track::with('blocks')->get();

        return view('admin.tracks.index', [
            'tracks' => $tracks
        ]);
    }

    /**
     * Show the form for creating a new track.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.tracks.create', [
            'users' => (new User)->whereUserIsTeacherOrTeacher()->get()
        ]);
    }

    /**
     * Store a track in storage.
     *
     * @param StoreTrackRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTrackRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('icon')) {
            $filename = ImageService::make($request->file('icon'), 'tracks');
            $data['icon'] = $filename;
        }
        $filename = ImageService::make($request->file('image'), 'tracks');
        $data['image'] = $filename;
        $teachers = $data['teacher_id'];

        $track = Track::create($data);
        $teachers[] = $track->curator_id;
        $track->teachers()->attach($teachers);

        return redirect()->route('admin.tracks.show', $track->id);
    }

    /**
     * Display the track.
     *
     * @param Track $track
     * @return Application|Factory|View
     */
    public function show(Track $track)
    {
        return view('admin.tracks.show', [
            'track' => $track,
            'blocks' => $track->blocks,
        ]);
    }

    /**
     * Show the form for editing the track.
     *
     * @param Track $track
     * @return Application|Factory|View
     */
    public function edit(Track $track): View|Factory|Application
    {
        return view('admin.tracks.edit', [
            'track' => $track,
            'users' => (new User)->whereUserIsTeacherOrTeacher()->get(),
            'teachers_ids' => $track->teacherIds,
        ]);
    }

    /**
     * Update the track.
     *
     * @param UpdateTrackRequest $request
     * @param Track $track
     * @return RedirectResponse
     */
    public function update(UpdateTrackRequest $request, Track $track): RedirectResponse
    {
        $data = $request->validated();


        if ($request->hasFile('icon')) {
            ImageService::deleteOld($track->icon, 'tracks');
            $filename = ImageService::make($request->file('icon'), 'tracks');
            $data['icon'] = $filename;
        }
        if ($request->hasFile('image')) {
            ImageService::deleteOld($track->image, 'tracks');
            $filename = ImageService::make($request->file('image'), 'tracks');
            $data['image'] = $filename;
        }
        $teachers = $data['teacher_id'];

        $teachers[] = $data['curator_id'];
        $track->teachers()->sync($teachers);
        $track->update($data);

        return redirect()->route('admin.tracks.show', $track->id);
    }


    /**
     * @param int $track_id
     * @return Application|RedirectResponse|\Illuminate\Routing\Redirector|void
     * @throws \Throwable
     */
    public function destroy(Request $request, $track_id)
    {
        $track = Track::where('id', $track_id)->first();
        if (!Hash::check($request->input('password'), auth()->user()->password)) {
            session()->flash('error', 'При удалении вы ввели неверный пароль, попробуйте снова');
            return back();
        }

        try {
            $track->deleteOrFail();
            return redirect()->route('admin.tracks.index');
        } catch (\Exception $exception) {
            abort(501);
        }
    }

    public function addTrackForUser($track_id)
    {
        $track = Track::where('id', $track_id)->first();
        $user = auth()->user()->id;
        $track->users()->toggle($user);
        $tracks = Track::all();
        $allAverageMark = [];
        foreach ($tracks as $track) {
            $allAverageMark[] = AverageMarkTrack::getMark($track);
        }
        return redirect()->route('admin.tracks.index');
    }


}
