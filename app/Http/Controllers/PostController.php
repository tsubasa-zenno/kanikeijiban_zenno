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
            'title' => 'required|max:50',
            'name' => 'required|max:20',
            'body' => 'required|max:500',
        ],
        [
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは50文字以内で入力してください。',
            'name.required' => '名前を入力してください。',
            'name.max' => '名前は20文字以内で入力してください。',
            'body.required' => '本文を入力してください。',
            'body.max' => '本文は500文字以内で入力してください。',
            
        ]);


        Post::create([
        'title' => $request->title,
        'name' => $request->name,
        'body' => $request->body
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
        'title' => 'required|max:50',
        'name' => 'required|max:20',
        'body' => 'required|max:500',
    ], [
        'title.required' => 'タイトルを入力してください。',
        'title.max' => 'タイトルは50文字以内で入力してください。',
        'name.required' => '名前を入力してください。',
        'name.max' => '名前は20文字以内で入力してください。',
        'body.required' => '本文を入力してください。',
        'body.max' => '本文は500文字以内で入力してください。',
    ]);

    $post->update([
        'title' => $request->title,
        'name' => $request->name,
        'body' => $request->body,
        'is_edited' => true,
        ]);

    return redirect('/posts');
}
}