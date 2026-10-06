<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>掲示板</title>

    <style>

        .top-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            border: 1px solid #000;
            background-color: #fff;
            text-decoration: none;
        }

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

        h3 span {
            font-size: 14px;
            font-weight: normal;
        }

        .error {
            color: red;
        }

        .edit-button:hover {
            background-color: #e5e5e5;
        }

        .edit-form {
            padding: 5px;
        }

        .edit-title {
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            padding: 8px;
        }

        .edit-body {
            display: block;
            width: 100%;
            max-width: 500px;
            height: 120px;
            box-sizing: border-box;
            margin-top: 10px;
            padding: 8px;
        }

        .edit-buttons {
            display: flex;
            gap: 8px;
            margin-top: 10px;
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

        .post h3 span {
            font-size: 14px;
            font-weight: normal;
            margin-left: 10px;
        }

        .post-body {
            white-space: pre-wrap;
        }

        .post-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .show-button,
        .delete-button,
        .edit-button{
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

<body id="top">

    <div id="app" data-posts="{{ json_encode($posts) }}"></div>

    <a href="#top" class="top-button">↑ページ上部に戻る</a>

    @vite('resources/js/app.jsx')

</body>
</html>