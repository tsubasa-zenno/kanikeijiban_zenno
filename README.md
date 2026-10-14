# Laravel × React 掲示板アプリ

## アプリケーション概要

LaravelとReactを使用して作成した掲示板アプリケーションです。

投稿の作成・閲覧・編集・削除ができます。

## 使用技術

- PHP 8.3以上
- Laravel 13
- React 19
- SQLite
- Tailwind CSS 4
- Vite 8

##環境構築方法

### 1. リポジトリをクローン

```bash
git clone https://github.com/tsubasa-zenno/kanikeijiban_zenno.git
cd kanikeijiban_zenno
```

### 2. SQLiteデータベースを作成s

```bash
touch database/database.sqlite
```

### 3. アプリケーションのセットアップ

```bash
composer run setup
```

## 起動方法

```bash
composer run dev
```

起動後、ブラウザで以下にアクセスします。

http://127.0.0.1:8000

## 実装した機能

- 投稿一覧表示
- 投稿の新規作成
- 投稿詳細表示
- 投稿の編集・更新
- 投稿の削除
- 入力バリデーションとエラーメッセージの表示
- 投稿日時・最終編集日時の表示
- 編集済み状態の表示