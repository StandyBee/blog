<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);

            $post = Post::create($data);

            $post->tags()->attach($tagIds);
            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post)
    {
        try {
            DB::beginTransaction();
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);

            $post->update($data);
            $post->tags()->sync($tagIds);
            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            abort(500);
        }

        return $post;
    }
}
