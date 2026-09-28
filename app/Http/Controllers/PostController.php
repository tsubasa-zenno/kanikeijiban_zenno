<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ],
        [
            'title.required' => 'タイトルを入力してください。',
            'body.required' => '本文を入力してください。',
        ]);


        Post::create([
        'title' => $request->title,
        'body' => $request->body,
        ]);

        return redirect('/posts'); 
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
    }


public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required',
        'body' => 'required',
    ], [
        'title.required' => 'タイトルを入力してください。',
        'body.required' => '本文を入力してください。',
    ]);

    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    return redirect('/posts');
}
}