<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\Track;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class HomeController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $posts = Post::latest()->limit(3)->get();
        $tracks = Track::all();

        return view('welcome', [
            'posts'=> $posts,
            'tracks'=> $tracks
        ]);
    }
    /**
     * @return Factory|View|Application
     */
    public function about(): Factory|View|Application
    {
        return view('about');
    }
}
