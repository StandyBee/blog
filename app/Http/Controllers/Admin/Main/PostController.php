<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Requests\Admin\Main\StorePostRequest;
use App\Http\Requests\Admin\Main\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('admin.post.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $post = $this->service->update($data, $post);

        return redirect()->route('admin.post.show', $post);
    }

    public function delete(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.post.index');
    }
}
