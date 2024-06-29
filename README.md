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
* 勤怠管理登録機能
* 勤怠管理一覧表示機能（個別・全体）
* ユーザー一覧表示機能

## 使用技術（実行環境）
* PHP7.4.9（使用言語）
* Laravel8.83.8（フレームワーク）
* MySQL8.0.26

# ER図
![ER図](https://github.com/syakuyakusystem/beginner-case/assets/166460196/c83bd470-d034-47af-ae5a-3d4a2c92cdb1)


# 環境構築
Dockerビルド
1. `git clone git@github.com:syakuyakusystem/beginner-case.git`
2. 任意の名前でローカルリポジトリの作成
3. `git remote set-url origin 作成したリポジトリのurl`
4. `git add .`
5. `git commit -m "リモートリポジトリの変更"`
6. `git push origin main`
7. DockerDesktopアプリを立ち上げる
8. `docker-composer up -d --build`
9. DockerDesktopアプリでコンテナが作成されているか確認
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

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=任意のメールアドレス
MAIL_PASSWORD=ssuhrftvrqfewmqc
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="任意のメールアドレス"
MAIL_FROM_NAME="${APP_NAME}"
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
