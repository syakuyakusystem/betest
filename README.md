# Atte（アット）
概要説明

人事評価のための勤怠管理システム

社員様の勤怠状況を個別に記録、管理するためのシステムです。

## 目的
人事評価
勤怠状況を記録、管理、保管し、人事評価に利用。

## アプリケーションURL
https://github.com/syakuyakusystem/beginner-case

## 関連リポジトリ
https://github.com/syakuyakusystem/beginner-case

## 機能一覧
* ログイン機能（個別ログイン）
* ユーザー登録機能

## 使用技術（実行環境）
* PHP7.4.9（使用言語）
* Laravel8.83.8（フレームワーク）
* MySQL8.0.26

# ER図
![ER図](https://github.com/syakuyakusystem/beginner-case/assets/166460196/6eb02198-d53c-4b5d-a72d-f224130cebbd)

# 環境構築
Dockerビルド
1. `git clone git@github.com:syakuyakusystem/beginner-case.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-composer up -d --build`
### Laravel環境構築
1. `docker-composer exec php bash`
2. `composer install`
3. 「.env.example」ファイルを「.env」ファイルに命名変更。<br>`cp .env.example .env`<br>または、新しく.envファイルを作成。
4. .envに以下の環境変数を追加
```DB_CONNECTION=mysql
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

## その他
#### URL
* 開発環境：　http://localhost/
* phpMyAdmin:：　http://localhost:8080/
