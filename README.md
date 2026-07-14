# furima
```
# GitHub から git clone する
git clone git@github.com:sugi3105/furima.git

# clone した furima フォルダに移動する
cd furima

# docker でビルドする
docker-compose up -d --build
```

## Laravel環境構築
1. `docker-compose exec php bash`
2. `composer install`
3. 'cp .env.example .env
4. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
5. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
6. アプリケーションキーの作成
・　php artisan key:generate

7. マイグレーションの実行
・　php artisan migrate:fresh --seed

8. ストレージリンク作成
.   php artisan storage:link

9. メール認証設定

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

10. 実行確認  
   `http://localhost/` へアクセスして動作確認をする  
   エラーが出て表示できない場合は `sudo chmod -R 777 ./src/*` コマンドを実行する  

11. Stripe設定
　　Stripe決済機能を利用する場合は.envに以下を設定してください。
   STRIPE_KEY=取得したキー
   STRIPE_SECRET=取得したシークレットキー

## 使用技術
   
   `php8.3.0`
   `Laravel8.83.27`
   `MySQL8.0.26`

## ER図
![ER図](ER.drawio.png)



　
　
## URL
  環境開発:http://localhost/
  phpMyAdmin: http://localhost:8080
