<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>投稿詳細</title>

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

        .return-button{
            padding: 5px 12px;
            font-size: 13.3333px;
            border: 1px solid #999;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #efefef;
            text-decoration: none;
        }

    </style>
</head>

<body>

    <h1>投稿詳細</h1>

    <hr>

    <div class="post">

        <h3>#{{ $post->id }} {{ $post->title }} 

            <span>投稿日時：{{ $post->created_at->format('Y年m月d日 H:i') }}</span>

        </h3>

        <h3>
            @if ($post->is_edited)
                <span>(編集済み)</span>
            @endif

            @if ($post->is_edited)
                <span>最終編集日時：{{ $post->updated_at->format('Y年m月d日 H:i') }}</span>
            @endif
        </h3>

        <h4>投稿者：{{ $post->name }}</h4>

        <p>{!! nl2br(e($post->body)) !!}</p>
    
    </div>

    <br>

    <a class="return-button" href="/posts">掲示板に戻る</a>

</body>
</html>