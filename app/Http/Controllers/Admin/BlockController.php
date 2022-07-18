<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Block\StoreBlockRequest;
use App\Http\Requests\Block\UpdateBlockRequest;
use App\Models\Block;
use App\Models\Exercise;
use App\Models\Track;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
     * @return RedirectResponse
     */
    public function store(StoreBlockRequest $request, Track $track)
    {
        $data = $request->validated();
        $data['track_id'] = $track->id;
        $data['user_id'] = auth()->user()->id;
        $data['image'] = ImageService::make($request->file('image'), 'blocks/images');
        $block = Block::create($data);
        return redirect()->route('admin.tracks.blocks.show', [$track->id, $block->id]);
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
     * @param UpdateBlockRequest $request
     * @param Track $track
     * @param Block $block
     * @return RedirectResponse|never
     * @throws \Throwable
     */
    public function update(UpdateBlockRequest $request, Track $track, Block $block)
    {
        $data = $request->validated();

        $image = $data['image']??null;
        unset($data['file']);
        if (!$image) {
            try {
                $block->updateOrFail($data);
                return redirect()->route('admin.tracks.blocks.show', [$track->id, $block->id]);
            } catch (\Exception $exception) {
                return abort(501);
            }
        }

        ImageService::deleteOld($block->image, 'blocks/images');
        $data['image'] = ImageService::make($image, 'posts/images');
        try {
            $block->updateOrFail($data);
            return redirect()->route('admin.tracks.blocks.show', [$track->id, $block->id]);
        } catch (\Exception $exception) {
            return abort(501, $exception);
        }
    }


    /**
     * @param Track $track
     * @param Block $block
     * @return RedirectResponse|void
     * @throws \Throwable
     */
    public function destroy(Request $request, Track $track, Block $block)
    {

        if(!Hash::check($request->input('password'), auth()->user()->password) ) {
            return back()->withErrors(['modal_password' => 'Неверный пароль']);
        }

        try {
            $block->deleteOrFail();
            return redirect()->route('admin.tracks.show', [$track->id]);
        } catch (\Exception $exception) {
            abort(501);
            // dd( $exception);
        }
    }
}
