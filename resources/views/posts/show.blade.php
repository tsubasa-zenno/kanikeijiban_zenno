<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        h3 span {
            font-size: 14px;
            font-weight: normal;
        }

        .error {
            color: red;
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

        .edit-buttons {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .show-button,
        .delete-button,
        .edit-button,
        .return-button {
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

    <div
        id="show-app"
        data-post="{{ json_encode($post) }}"
    >
    </div>

    @vite('resources/js/app.jsx')

</body>
</html>