<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use App\Services\ImageService;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12);
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

        $date = Carbon::parse($post->created_at);
        $posts = Post::limit(6)->get();
        return view('admin.posts.show', compact('post','date', 'posts'));
    }


    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_updater_id'] = auth()->user()->id;
        $images = $data['file']??null;
        unset($data['file']);
        if (!$images) {
            try {
                $post->updateOrFail($data);
                return redirect()->route('admin.posts.show', $post->id);
            } catch (\Exception $exception) {
                return abort(501);
            }
        }
        foreach ($post->images as $image) {
            $post_images = PostImage::where('post_id', $post->id)->get();
            foreach ($post_images as $post_image) {
                $post_image->delete();
            }
            ImageService::deleteOld($image->name, 'posts/images');
        }
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
        return redirect()->route('admin.posts.show', $post->id);
    }
//


    public function destroy(Post $post)
    {
        try {
            $post->deleteOrFail();
        } catch (\Exception $e) {
            abort(501);
        }
        return redirect()->route('admin.posts.index');
    }
}
