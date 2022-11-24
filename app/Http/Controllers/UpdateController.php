<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Block;
use App\Models\Track;
use App\Models\Exercise;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update()
    {
        $tracks = Track::all();
        $posts = Post::all();
        $users = User::all();
        $blocks = Block::all();
        $exercises = Exercise::all();

        $this->updating($tracks);
        $this->updating($posts);
        $this->updating($users);
        $this->updating($blocks);
        $this->updating($exercises);
    
    }

    public function updating($array) : void
    {
        foreach($array as $item) {
            $item->update();
        }
    }

}
