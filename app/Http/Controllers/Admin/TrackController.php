<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Track\StoreTrackRequest;
use App\Http\Requests\Track\UpdateTrackRequest;
use App\Models\Block;
use App\Models\Track;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TrackController extends Controller
{
    /**
     * Display a listing of the tracks.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('admin.tracks.index', [
            'tracks' => Track::all(),
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
            'users' => User::where('role_id', 3)->orWhere('role_id', 2)->get()
        ]);
    }

    /**
     * Store a track in storage.
     *
     * @param  \App\Http\Requests\Track\StoreTrackRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTrackRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('icon')) {
            $filename = ImageService::make($request->file('icon'), 'tracks');
            $data['icon'] = $filename;
        }
        $filename = ImageService::make($request->file('image'), 'tracks');
        $data['image'] = $filename;
//        dd($data);
        $track = Track::create($data);

        return redirect()->route('admin.tracks.show', $track->id);
    }

    /**
     * Display the track.
     *
     * @param  \App\Models\Track  $track
     * @return Application|Factory|View
     */
    public function show(Track $track)
    {
        return view('admin.tracks.show', [
            'track' => $track,
            'blocks' => Block::where('track_id', $track->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the track.
     *
     * @param  \App\Models\Track  $track
     * @return Application|Factory|View
     */
    public function edit(Track $track)
    {
        return view('admin.tracks.edit', [
            'track' => $track,
            'users' => User::where('role_id', 3)->orWhere('role_id', 2)->get()
        ]);
    }

    /**
     * Update the track.
     *
     * @param  \App\Http\Requests\Track\UpdateTrackRequest  $request
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTrackRequest $request, Track $track)
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
//        dd($data);
        $track->update($data);

        return redirect()->route('admin.tracks.show', $track->id);
    }


    /**
     * @param Track $track
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     * @throws \Throwable
     */
    public function destroy(Track $track)
    {
        try {
            $track->deleteOrFail();
            return redirect('admin.tracks.index');
        } catch (\Exception $exception) {
            abort(501);
        }
    }
}
