# coachtechフリマ

概要説明
独自フリマアプリ
coachtechブランドのアイテムを出品する新規のフリマアプリです。<br>
会員登録者様はプロフィールの登録ができ、配送先の変更も可能です。<br>
お気に入り登録・コメント機能があり、商品の客観的な評価を確認できます。<br>
会員登録をしていない場合も商品詳細ページを確認することができます。

## 目的
自社でフリマアプリを運営し、coachtechブランドのアイテムを出品する

## アプリケーションURL
https://github.com/syakuyaku514/market-application

## 関連リポジトリ
https://github.com:syakuyaku514/market-application

## 機能一覧
* ユーザー別ログイン（認証機能）
* 商品一覧、商品詳細表示
* 商品お気に入り登録、登録解除
* 商品コメント登録、コメント削除
* ユーザープロフィール登録、変更
* ユーザー商品出品
* ユーザー商品購入

## 使用技術（実行環境）
* PHP 7.4.9（使用言語）
* Laravel 8.83.8（フレームワーク）
* MySQL 8.0.26


# ER図
![ER図](https://github.com/user-attachments/assets/eb5c2cc2-555b-4df7-b262-d0673e4cd6f2)







# 環境構築
Dockerビルド
1. `git clone git@github.com:syakuyaku514/market-application.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-composer up -d --build`
4. DockerDesktopアプリでコンテナが作成されているか確認

###Laravel環境構築
1. `docker-composer exec php bash`
2. `composer install`
3. [.env.example]ファイルを[.env]ファイルに命名変更。<br>`cp .env.example .env`<br>または、新しく.envファイルを作成。
4. .envに以下の環境変数を追加
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
```
php artisan key:generate
``` 
6. マイグレーションの実行
```
php artisan migrate
```
7. シーディングの実行 
```
php artisan db:seed
```
8. シンボリックリンクの作成 
```
php artisan storage:link
```


## その他
カテゴリーのデザインが複数選択だったため、出品時のカテゴリーのフォームをチェックボックスにしています。
#### URL
* 開発環境    : http://localhost/
* phpMyAdmin  : http://localhost:8080/
