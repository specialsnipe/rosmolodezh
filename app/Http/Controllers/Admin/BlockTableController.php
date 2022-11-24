<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Track\StoreTrackRequest;
use App\Http\Requests\Track\UpdateTrackRequest;
use App\Models\Admin\Block;
use App\Models\Admin\Track;
use App\Models\Admin\User;
use App\Services\AverageMark\AverageMarkBlock;
use App\Services\ImageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Block\StoreBlockTableRequest;

class BlockTableController extends Controller
{
    /**
     * Display a listing of the tracks.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $blocks = Block::paginate(20);
        $allAverageMark = [];

        foreach ($blocks as $block) {
            // $track->academicPerformance = AverageMarkTrack::getMark($track);
            $block->averageMark = AverageMarkBlock::getMark($block);
        }
        return view('admin.blocks.table', [
            'blocks' => $blocks
        ]);
    }
    /**
     * Display a listing of the tracks.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $tracks = Track::all();
        return view('admin.blocks.table-create', [
            'tracks' => $tracks
        ]);
    }

    public function store(StoreBlockTableRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['image'] = ImageService::make($request->file('image'), 'blocks/images');
        $block = Block::create($data);

        return redirect()->route("admin.blocks.table");
    }

    /**
     * @param Block $block
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     * @throws \Throwable
     */
    public function destroy(Request $request, Block $block)
    {

        if (!Hash::check($request->input('password'), auth()->user()->password)) {
            session()->flash('error', 'При удалении вы ввели неверный пароль, попробуйте снова');
            return back();
        }

        try {
            $block->deleteOrFail();
            return redirect()->route('admin.blocks.table');
        } catch (\Exception $exception) {
            abort(501);
        }
    }

}
