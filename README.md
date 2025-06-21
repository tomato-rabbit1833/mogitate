使用技術スタック
| 項目         | 内容                      |
| ---------- | ----------------------- |
| 言語         | PHP 8.x                 |
| フレームワーク    | Laravel 8.83.8          |
| DB         | MySQL 8.x               |
| Webサーバー    | nginx                   |
| コンテナ管理     | Docker / Docker Compose |
| パッケージマネージャ | Composer                |
| UI         | Bootstrap 4             |

プロジェクト構成
.
├── docker/                 # Docker関係（MySQLなど）
├── src/                    # Laravel本体（`src`がルートディレクトリ）
│   ├── app/
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   └── ...
├── docker-compose.yml
├── .env.example            # 環境変数のテンプレート
└── README.md

セットアップ手順
① リポジトリをクローン
cd coachtech/laravel
git clone /laravel-docker-template.git
mv laravel-docker-template
cd mogitate
git remote set-url origin 作成したリポジトリのurl
git remote -v
git add .
git commit -m "リモートリポジトリの変更"
git push origin main

② Docker の設定
docker-compose up -d --build
code . 

③ Laravel のパッケージのインストール
docker-compose exec php bash
composer install
php artisan key:generate
php artisan migrate
php artisan storage:link
※ 必要なら php artisan db:seed

④ .env ファイルの作成
cd src
cp .env.example .env

アクセスURL（初期状態）
アプリ: http://localhost:81

phpMyAdmin: http://localhost:8080

ユーザー名: root

パスワード: root

データベース名: laravel_db

注意点
画像ファイルは storage/app/public/products に保存されます

.gitignore で除外されないよう .gitkeep を設置済み

Laravelのログやセッションも storage 以下に保存されます

自分の環境だとポート番号が8080だとnginxが起動しないのでポート番号が8180になっています。
なのでローカルホストの後ろは:81をつけてください
