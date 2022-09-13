<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\Team;
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
        $phraseSize;
        $phrasesCount = ($phrases->count() >= 4) ? 4 : $phrases->count();
        $phrases = $phrases->random($phrasesCount)->values();
        $posts = Post::latest()->limit(4)->get();

        switch ($phrasesCount) {
            case '1':
                $phraseSize = 'col-md-12';
                break;

            default:
                $phraseSize = 'col-md-6';
                break;
        }
        switch ($phrasesCount) {
            case '1':
                $phraseSize .= ' col-lg-12';
                break;

            case '2':
                $phraseSize .= ' col-lg-6';
                break;

            case '3':
                $phraseSize .= ' col-lg-4';
                break;

            default:
                $phraseSize .= ' col-lg-3';
                break;
        }

        return view('welcome', [
            'posts' => $posts,
            'tracks' => $this->tracks,
            'occupations' => $this->occupations,
            'genders' => $this->genders,
            'slides' => $slides,
            'phrases' => $phrases,
            'phrases_count' => $phrasesCount,
            'phraseSize' => $phraseSize,
        ]);
    }

    /**
     * About page
     *
     */
    public function about()
    {

        $tracks = Track::all();
        return view('about', compact('tracks'));
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
        $team = Team::all();
        return view('teams',compact('team'));
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
        $exercises = Exercise::filter($filterExercises)->get()->load('block', );

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
