<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>投稿編集</title>

    <style>

        body {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }

        h1 {
            text-align: center;
        }

        .post {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }

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

    <hr>

    @error('title')
        <p class="error">※{{ $message }}</p>
    @enderror

    @error('body')
        <p class="error">※{{ $message }}</p>
    @enderror
    
    <div class="post">

        <h3>#{{ $post->id }} {{ $post->title }} 

            <span>投稿日時：{{ $post->created_at->format('Y年m月d日 H:i') }}</span>

        </h3>

        <h3>
            @if ($post->is_edited)
                <span>(編集済み)</span>
            @endif

            @if ($post->is_edited)
                <span>編集日時：{{ $post->updated_at->format('Y年m月d日 H:i') }}</span>
            @endif
        </h3>

        <h4>投稿者：{{ $post->name }}</h4>

        <p>{!! nl2br(e($post->body)) !!}</p>
    
    </div>

    <hr>

    <h2>編集する</h2>

    <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        @method('PUT')

        <h3>タイトル<span>※50字以内</span></h3>
        <input type="text" name="title" value="{{ $post->title }}">            
            
            @error('title')
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