<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Track;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TrackTableController extends Controller
{
    /**
     * Display a listing of the tracks.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $tracks = Track::with('blocks')->paginate(20);

        return view('admin.tracks.table', [
            'tracks' => $tracks
        ]);
    }

    /**
     * @param int $track_id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
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
            return redirect()->route('admin.tracks.table');
        } catch (\Exception $exception) {
            abort(501);
        }
    }

}
