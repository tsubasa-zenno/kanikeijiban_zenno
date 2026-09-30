<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>投稿編集</title>

    <style>
        h3 span {
            font-size: 14px;
            font-weight: normal;
        }

        .error {
            color: red;
        }

    </style>
</head>

<body>

    <h1>投稿編集</h1>
    
    @error('name')
        <p class="error">※{{ $message }}</p>
    @enderror

    @error('title')
        <p class="error">※{{ $message }}</p>
    @enderror

    @error('body')
        <p class="error">※{{ $message }}</p>
    @enderror

    <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        @method('PUT')

        <h3>タイトル<span>※50字以内</span></h3>
        <input type="text" name="title" value="{{ $post->title }}">            
            
            @error('title')
                <p class="error">※{{ $message }}</p>
            @enderror
        
        <h3>投稿者名<span>※20字以内</span></h3>
        <input type="text" name="name" value="{{ $post->name }}">
                    
            @error('name')
                <p class="error">※{{ $message }}</p>
            @enderror

        <h3>本文<span>※500字以内</span></h3>
        <textarea name="body">{{ $post->body }}</textarea>
            
            @error('body')
                <p class="error">※{{ $message }}</p>
            @enderror

        <br><br>

        <button type="submit">更新する</button>
    </form>

    <br>

    <a href="/posts">掲示板に戻る</a>

</body>
</html>