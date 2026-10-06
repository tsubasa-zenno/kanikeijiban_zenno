import { createRoot } from 'react-dom/client';
import { useState } from 'react';

function PostShow() {
    const appElement = document.getElementById('show-app');
    const post = JSON.parse(appElement.dataset.post);
    
    const [isEditing, setIsEditing] = useState(false);
    const [editTitle, setEditTitle] = useState(post.title);
    const [editBody, setEditBody] = useState(post.body);
    const [editErrors, setEditErrors] = useState({});

    const handleUpdate = async () => {
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        const response = await fetch(`/posts/${post.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                title: editTitle,
                body: editBody,
            }),
        });

        if (response.status === 422) {
            const data = await response.json();
            setEditErrors(data.errors);
            return;
        }

        window.location.reload();
    };

    const handleDelete = async () => {
        const confirmed = confirm('この投稿を削除しますか？');

        if (!confirmed) {
            return;
        }

        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        await fetch(`/posts/${post.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
        });

        window.location.href = '/posts';
    };

    return (
        <div>
            <h1>投稿詳細</h1>

            <hr />

            <div className="post">

                <h3>
                    #{post.id} {post.title}

                    <span>
                        投稿日時：
                        {new Date(post.created_at).toLocaleString('ja-JP')}
                    </span>
                </h3>

                <h3>
                    {post.is_edited && (
                        <span>(編集済み)</span>
                    )}

                    {post.is_edited && (
                        <span>
                            最終編集日時：
                            {new Date(post.updated_at).toLocaleString('ja-JP')}
                        </span>
                    )}
                </h3>

                <h4>
                    投稿者：{post.name}
                </h4>

                <p className="post-body">
                    {post.body}
                </p>

                <div className="post-buttons">

                    <button
                        className="edit-button"
                        onClick={() => setIsEditing(true)}
                    >
                        編集
                    </button>

                    <button
                        className="delete-button"
                        onClick={handleDelete}
                    >
                        削除
                    </button>

                </div>

            </div>

            {isEditing && (
                <div className="edit-form">

                <hr />

                <h3>投稿を編集</h3>

                <h3>
                    タイトル
                    <span>※50字以内</span>
                </h3>

                <input
                    className="edit-title"
                    type="text"
                    value={editTitle}
                    onChange={(e) => setEditTitle(e.target.value)}
                />

                {editErrors.title && (
                    <p className="error">
                        ※{editErrors.title[0]}
                    </p>
                )}

                <h3>
                    本文
                    <span>※500字以内</span>
                </h3>

                <textarea
                    className="edit-body"
                    value={editBody}
                    onChange={(e) => setEditBody(e.target.value)}
                />

                {editErrors.body && (
                    <p className="error">
                        ※{editErrors.body[0]}
                    </p>
                )}

                <div className="edit-buttons">

                    <button
                        className="update-button"
                        onClick={handleUpdate}
                    >
                    更新
                    </button>

                    <button
                    className="cancel-button"
                    onClick={() => {
                        setEditTitle(post.title);
                        setEditBody(post.body);
                        setEditErrors({});
                        setIsEditing(false);
                    }}
                    >
                    キャンセル
                    </button>

                </div>

        </div>
)}

            <br />
        
            <a
                className="return-button"
                href="/posts"
            >
                掲示板に戻る
            </a>
        </div>
    );
}

function PostForm() {
    const [title, setTitle] = useState('');
    const [name, setName] = useState('');
    const [body, setBody] = useState('');
    const [errors, setErrors] = useState({});

    const handleSubmit = async () => {
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        const response = await fetch('/posts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                title: title,
                name: name,
                body: body,
            }),
        });

        if (response.status === 422) {
            const data = await response.json();
            setErrors(data.errors);
            return;
        }

        window.location.reload();
    };
    
    return (
        <div className="post-form">

            <hr />

            <h2>投稿する</h2>

            <h3>
                タイトル
                <span>※50字以内</span>
            </h3>

            <input
                type="text"
                value={title}
                onChange={(e) => setTitle(e.target.value)}
            />

            {errors.title && (
                <p className="error">※{errors.title[0]}</p>
            )}

            <h3>
                投稿者名
                <span>※20字以内</span>
            </h3>

            <input
                type="text"
                value={name}
                onChange={(e) => setName(e.target.value)}
            />

            {errors.name && (
                <p className="error">※{errors.name[0]}</p>
            )}

            <h3>
                本文
                <span>※500字以内</span>
            </h3>

            <textarea
                value={body}
                onChange={(e) => setBody(e.target.value)}
            />

            {errors.body && (
                <p className="error">※{errors.body[0]}</p>
            )}

            <br />
            <br />

            <button type="button" onClick={handleSubmit}>
                投稿する
            </button>

        </div>
    );
}

function PostItem({ post }) {
    const [isEditing, setIsEditing] = useState(false);

    const [editTitle, setEditTitle] = useState(post.title);
    const [editBody, setEditBody] = useState(post.body);
    const [editErrors, setEditErrors] = useState({});

    const handleUpdate = async () => {
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        const response = await fetch(`/posts/${post.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                title: editTitle,
                body: editBody,
            }),
        });

        if (response.status === 422) {
            const data = await response.json();
            setEditErrors(data.errors);
            return;
        }

        window.location.reload();
    };

    const handleDelete = async () => {
        const confirmed = confirm('この投稿を削除しますか？');

        if (!confirmed) {
            return;
        }

        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        await fetch(`/posts/${post.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
        });

        window.location.reload();
    };

    return (
        <div className="post">

            <h3>
                #{post.id} {post.title}

                <span>
                    投稿日時：
                    {new Date(post.created_at).toLocaleString('ja-JP')}
                </span>
            </h3>

            <h3>
                {post.is_edited && (
                    <span>(編集済み)</span>
                )}

                {post.is_edited && (
                    <span>
                        最終編集日時：
                        {new Date(post.updated_at).toLocaleString('ja-JP')}
                    </span>
                )}
            </h3>

            <h4>
                投稿者：{post.name}
            </h4>

            <p className="post-body">
                {post.body}
            </p>

            <div className="post-buttons">

                <a
                    className="show-button"
                    href={`/posts/${post.id}/show`}
                >
                    詳細
                </a>

                <button
                    className="edit-button"
                    onClick={() => setIsEditing(true)}
                >
                    編集
                </button>

                <button
                    className="delete-button"
                    onClick={handleDelete}
                >
                    削除
                </button>

            </div>

            {isEditing && (
                <div className="edit-form">

                    <hr />

                    <h3>投稿を編集</h3>

                    <h3>
                        タイトル
                        <span>※50字以内</span>
                    </h3>

                    <input
                        className="edit-title"
                        type="text"
                        value={editTitle}
                        onChange={(e) => setEditTitle(e.target.value)}
                    />

                    {editErrors.title && (
                        <p className="error">
                            ※{editErrors.title[0]}
                        </p>
                    )}

                    <h3>
                        本文
                        <span>※500字以内</span>
                    </h3>

                    <textarea
                        className="edit-body"
                        value={editBody}
                        onChange={(e) => setEditBody(e.target.value)}
                    />

                    {editErrors.body && (
                        <p className="error">
                            ※{editErrors.body[0]}
                        </p>
                    )}

                    <div className="edit-buttons">

                        <button
                            className="update-button"
                            onClick={handleUpdate}
                        >
                            更新
                        </button>

                        <button
                            className="cancel-button"
                            onClick={() => {
                                setEditTitle(post.title);
                                setEditBody(post.body);
                                setEditErrors({});
                                setIsEditing(false);
                            }}
                        >
                            キャンセル
                        </button>

                    </div>

                </div>
            )}

        </div>
    );
};

function App() {
    const appElement = document.getElementById('app');
    const posts = JSON.parse(appElement.dataset.posts);

    return (
        <div>
            <h1>掲示板</h1>

            <hr />
            
            <h2>投稿一覧</h2>

            {posts.map((post) => (
                <PostItem key={post.id} post={post} />
            ))}

            <PostForm />
        </div>
    );
}

const appElement = document.getElementById('app');
const showAppElement = document.getElementById('show-app');

if (appElement) {
    createRoot(appElement).render(
        <App />
    );
}

if (showAppElement) {
    createRoot(showAppElement).render(
        <PostShow />
    );
}