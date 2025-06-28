<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\IndexPostResource;
use App\Http\Resources\Post\ShowPostResource;
use App\Http\Resources\Post\StorePostResource;
use App\Http\Resources\Post\UpdatePostResource;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Requests\Post\DestroyPostRequest;

class PostController extends Controller
{
    public function index(IndexPostRequest $request)
    {
        return response()->json([
            'message' => 'Posts fetched successfully.',
            'data'    => IndexPostResource::collection(Post::with('user')->get())

        ]);
    }

    public function show(IndexPostRequest $request, Post $post)
    {
        return response()->json([
            'message' => 'Post fetched successfully.',
            'data'    => new ShowPostResource($post)

        ]);
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title'   => $request->title,
            'body'    => $request->body,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Post created successfully.',
            'data'    => new StorePostResource($post)
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response()->json([
            'message' => 'Post updated successfully.',
            'data' => new UpdatePostResource($post)
        ]);
    }

    public function destroy(DestroyPostRequest $request, Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted.']);
    }
}
