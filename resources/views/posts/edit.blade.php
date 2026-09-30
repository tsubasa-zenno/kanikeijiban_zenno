<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>投稿編集</title>
</head>

<body>

    <h1>投稿編集</h1>

    <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        @method('PUT')

        <h3>投稿者名</h3>
        <input type="text" name="name" value="{{ $post->name }}">

        <h3>タイトル</h3>
        <input type="text" name="title" value="{{ $post->title }}">

        <h3>本文</h3>
        <textarea name="body">{{ $post->body }}</textarea>

        <br><br>

        <button type="submit">更新する</button>
    </form>

    <br>

    <a href="/posts">掲示板に戻る</a>

</body>
</html>