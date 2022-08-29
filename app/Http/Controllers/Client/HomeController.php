<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\Track;
use App\Models\Gender;
use App\Models\Phrase;
use App\Models\Exercise;
use App\Models\Occupation;
use App\Models\SliderItem;
use App\Models\Information;
use App\Http\Filters\SearchFilter;
use App\Http\Controllers\Controller;
use App\Helpers\General\CollectionHelper;
use App\Http\Requests\Search\FilterRequest;

class HomeController extends Controller
{
    /**
     * index page
     *
     */

    public $genders;
    public $occupations;
    public $tracks;
    public $settings;


    public function __construct()
    {
        $this->genders = Gender::all();
        $this->occupations = Occupation::all();
        $this->tracks = Track::all();
        $this->settings = Information::first();
    }

    public function index()
    {
        $slides = SliderItem::all();
        $phrases = Phrase::all();
        $phrasesCount = ($phrases->count() >= 4) ? 4 : $phrases->count();
        $phrases = $phrases->random($phrasesCount)->values();
        $posts = Post::latest()->limit(4)->get();

        dd(auth()->user()->getSolvedTrackExercisesAttribute(1), auth()->user()->getAnswerMarkCountAttribute(1), );
        return view('welcome', [
            'posts' => $posts,
            'tracks' => $this->tracks,
            'occupations' => $this->occupations,
            'genders' => $this->genders,
            'slides' => $slides,
            'phrases' => $phrases,
            'phrases_count' => $phrasesCount
        ]);
    }

    /**
     * About page
     *
     */
    public function about()
    {
        return view('about');
    }

    /**
     *Сontacts page
     *
     */
    public function contacts()
    {
        return view('contacts', [
            'settings'=>$this->settings
        ]);
    }

    /**
     *Сontacts page
     *
     */
    public function teams()
    {
        return view('teams');
    }

    /**
     *Сontacts page
     *
     */
    public function search(FilterRequest $request)
    {

        $data = $request->validated();
        if (!isset($data['search'])) {
            $posts = null;
            return view('search.search', compact('posts'));
        }
        $filterPosts = app()->make(SearchFilter::class, ['queryParams' => array_filter($data)]);
        $filterExercises = app()->make(SearchFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filterPosts)->get();
        foreach ($posts as $post) {
            $post['table'] = 'posts';
        }
        $exercises = Exercise::filter($filterExercises)->get();
        foreach ($exercises as $exercise) {
            $exercise['table'] = 'exercises';
        }
        $unionCollection = $posts->merge($exercises);
        $results = CollectionHelper::paginate($unionCollection, 20);

        $search = $data['search'];
        return view('search.search', compact('results', 'search'));
    }

    public function exercisesSearch(FilterRequest $request)
    {

        $data = $request->validated();

        if (!isset($data['search'])) {
            $exercises = null;
            return view('search.exercises', compact('exercises'));
        }
        $filterExercises = app()->make(SearchFilter::class, ['queryParams' => array_filter($data)]);
        $exercises = Exercise::filter($filterExercises)->paginate(20);
        $search = $data['search'];
        return view('search.exercises', compact('exercises', 'search'));
    }

    public function postsSearch(FilterRequest $request)
    {
        $data = $request->validated();
        if (!isset($data['search'])) {
            $posts = null;
            return view('search.posts', compact('posts'));
        }
        $filterPosts = app()->make(SearchFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filterPosts)->paginate(20);
        $search = $data['search'];
        return view('search.posts', compact('posts', 'search'));
    }
}
