<?php

namespace App\Http\Controllers\Client;

use App\Models\Block;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Block\StoreBlockRequest;

class BlockController extends Controller
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
    public function create(Track $track)
    {
        $this->authorize('create', [Block::class, $track]);
        return view('profile.blocks.create', ['track' => $track]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlockRequest $request, Track $track)
    {
        $this->authorize('create', [Block::class, $track]);

        $data = $request->validated();
        $data['track_id'] = $track->id;
        $data['user_id'] = auth()->user()->id;
        $data['image'] = ImageService::make($request->file('image'), 'blocks/images');
        $priority = Block::where('track_id', $track->id)->get()->sortByDesc('id')->first() !== null
            ? Block::where('track_id', $track->id)->get()->sortByDesc('id')->first()->priority
            : 0;
        $priority++;
        $data['priority'] = $priority;
        $block = Block::create($data);

        return redirect()->route('tracks.blocks.show', [$block->track_id,$block->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track, Block $block)
    {

        if(auth()->user()->role->name === 'student') {
            if (!auth()->user()->started_blocks->where('block_id', $block->id)->first()) {
                auth()->user()->started_blocks()->toggle($block);
            }

            return view('profile.blocks.student.show',compact('block'));
        } else {
            return view('profile.blocks.teacher.show',compact('block'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track, Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Track $track,  Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function start(Track $track, Block $block)
    {
        auth()->user()->started_blocks()->toggle($block);
        return redirect()->route('profile.tracks.block.show',[$track->id, $block->id]);
    }
}
