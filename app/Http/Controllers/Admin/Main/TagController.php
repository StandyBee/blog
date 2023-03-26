<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Requests\Admin\Main\StoreTagRequest;
use App\Http\Requests\Admin\Main\UpdateTagRequest;
use App\Models\Tag;

class TagController extends BaseController
{
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $data = $request->validated();

        Tag::create($data);

        return redirect()->route('admin.tag.index');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $data = $request->validated();

        $tag->update($data);

        return redirect()->route('admin.tag.show', $tag);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tag.index');
    }
}
