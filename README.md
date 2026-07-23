# furima

## Laravel環境構築

1. リポジトリをクローンする

```bash
git clone git@github.com:sugi3105/furima.git
```

2. プロジェクトディレクトリへ移動する

```bash
cd furima
```

3. Dockerコンテナに入る

```bash
docker-compose up -d --build
```

4. phpコンテナに入る

```bash
docker-compose exec php bash`
```

5. Composerパッケージをインストールする

```bash
composer install`
```

6. `.env` ファイルを作成する

```bash
`cp .env.example .env`
```

7. `.env`に以下の環境変数を追加`

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

8. アプリケーションキーの作成

```bash
   php artisan key:generate
```

9. マイグレーションの実行

```bash
   php artisan migrate:fresh --seed
```

10. ストレージリンク作成

```bash
   php artisan storage:link
```

11. メール認証設定

メール認証には MailHog を使用しています。
.env に以下を設定してください。

```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=test@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

認証メールは以下で確認できます。

```
http://localhost:8025
```

12. 実行確認

```bash
http://localhost/` へアクセスして動作確認をする
```

エラーが出て表示できない場合は、以下を実行してください

```bash
`sudo chmod -R 777 ./src/*`
```

13. Stripe設定

Stripe決済機能を利用する場合は.envに以下を設定してください。

```env
STRIPE_KEY=取得したキー
STRIPE_SECRET=取得したシークレットキー
```

## 使用技術

- php8.3.0
- Laravel8.83.27
- MySQL8.0.26
- Docker
- Mailhog
- Stripe

## ER図

![ER図](ER.drawio.png)

　

　

## URL

- 開発環境:http://localhost/
- phpMyAdmin: http://localhost:8080
- Mailhog: http://localhost:8025
