<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\Track;
use App\Models\Gender;
use App\Models\Occupation;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class HomeController extends Controller
{
    /**
     * index page
     *
     */

    public $genders;
    public $occupations;
    public $tracks;

    public function __construct()
    {
        $this->genders = Gender::all();
        $this->occupations = Occupation::all();
        $this->tracks = Track::all();
    }

    public function index()
    {
        $posts = Post::latest()->limit(4)->get();

        return view('welcome', [
            'posts' =>$posts,
            'tracks' => $this->tracks,
            'occupations' => $this->occupations,
            'genders' => $this->genders,
        ]);
    }
    /**
     * About page
     *
     */
    public function about()
    {
        return view('welcome');
    }
}
