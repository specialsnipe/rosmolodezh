<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Block\StoreBlockRequest;
use App\Http\Requests\Block\UpdateBlockRequest;
use App\Models\Block;
use App\Models\Track;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Track $track)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Track $track)
    {
        return view('admin.blocks.create', [
            'track' => $track,
            'users' => User::where('role_id', 2)->orWhere('role_id', 3)->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Block\StoreBlockRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlockRequest $request, Track $track)
    {
        $data = $request->validated();
        $data['track_id'] = $track->id;
        $data['user_id'] = auth()->user()->id;
        $data['date_start'] = now();
        $data['date_end'] = now();
        $data['image'] = ImageService::make($request->file('image'), 'blocks');
        $block = Block::create($data);
        return redirect()->route('admin.blocks.show', [$track->id, $block->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Block $block
     * @return Application|Factory|View
     */
    public function show(Track $track, Block $block)
    {
        return view('admin.blocks.show', compact('track', 'block'));
    }

    /**
     * @param Track $track
     * @param Block $block
     * @return Application|Factory|View
     */
    public function edit(Track $track, Block $block)
    {
        return view('admin.blocks.edit', compact('track', 'block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Block\UpdateBlockRequest $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlockRequest $request, Track $track, Block $block)
    {
        $data = $request->validated();
        $data['track_id'] = $track->id;
        $data['user_id'] = auth()->user()->id;
        $data['date_start'] = now();
        $data['date_end'] = now();
        $data['image'] = ImageService::make($request->file('image'), 'blocks');
        $block = Block::create($data);
        return redirect()->route('admin.blocks.show', [$track->id, $block->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track, Block $block)
    {
        //
    }
}
