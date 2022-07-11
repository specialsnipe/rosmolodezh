<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use App\Services\ImageService;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        return view('admin.posts.create');
    }


    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $images = $data['file'];
        unset($data['file']);
        $post = Post::firstOrCreate($data);
//        dd($images);
        foreach ($images as $image) {
            $filename = ImageService::make($image, 'posts/images');
            $imageData = [
                'name' => $filename,
                'post_id' => $post->id,
            ];
            $post_image = PostImage::create($imageData);
            $post_image->update([
                'url' => $post_image->original_image,
            ]);
        }
        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        //
    }
}
