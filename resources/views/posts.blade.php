<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>掲示板</title>

    <style>
        body {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }

        h1 {
            text-align: center;
        }

        .post-form {
            margin-bottom: 40px;
        }

        .post {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }

        .post h3 {
            margin: 5px 0;
        }

        .post h4 {
            margin: 5px 0;
        }

        .error {
            color: red;
        }

        .delete-button,
        .edit-button {
            padding: 5px 12px;
            font-size: 13.3333px;
            border: 1px solid #999;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #efefef;
            text-decoration: none;
        }

        .edit-button:hover {
            background-color: #e5e5e5;
        }

        .post-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
            
    }

    </style>
</head>

<body>

    @error('name')
                <p class="error">※{{ $message }}</p>
            @enderror

    @error('title')
                <p class="error">※{{ $message }}</p>
            @enderror

    @error('body')
                <p class="error">※{{ $message }}</p>
            @enderror



    <h1>掲示板</h1>

    <hr>

    <h2>投稿一覧</h2>

    @foreach ($posts as $post)

        <div class="post">

            <h3>#{{ $post->id }} {{ $post->title }} </h3>
            <h4>投稿者：{{ $post->name }}</h4>

            <p>{!! nl2br(e($post->body)) !!}</p>

            <div class="post-buttons">

                <form 
                    method="POST" action="/posts/{{ $post->id }}"
                    onsubmit="return confirm('この投稿を削除しますか？');"
                >
                    
                    @csrf
                    @method('DELETE')

                    <button class="delete-button" type="submit">削除</button>
                </form>

                <a class="edit-button" href="/posts/{{ $post->id }}/edit">編集</a>

            </div>

        </div>

    @endforeach

    <hr>

    <div class="post-form">

        <h2>投稿する</h2>

        <form method="POST" action="/posts">
            @csrf

            <h3>タイトル</h3>
            <input type="text" name="title">

            @error('title')
                <p class="error">※{{ $message }}</p>
            @enderror

            <h3>投稿者名</h3>
            <input type="text" name="name">
            
            @error('name')
                <p class="error">※{{ $message }}</p>
            @enderror

            <h3>本文</h3>
            <textarea name="body"></textarea>

            @error('body')
                <p class="error">※{{ $message }}</p>
            @enderror

            <br><br>

            <button type="submit">投稿する</button>
        </form>

    </div>


</body>
</html>