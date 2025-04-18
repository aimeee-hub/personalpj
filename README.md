## 商品管理システム

## 商品管理システム

### 概要
このシステムでは商品の在庫管理を行うことができます。
商品のカテゴリごとの登録から編集、削除まで行うことができ、各商品の在庫を調整管理することができます。

### 主な機能
* ログイン・ログアウト機能
* 商品一覧画面
* 商品の新規登録・編集・削除機能

### テストアカウント情報
ID：test1@techis
パスワード：testtest

### 環境構築手順

* Gitクローン
* .env.example をコピーして .env を作成
* MySQLのデータベース作成（名前：item_management）
* Macの場合 .env の DB_PASSWORD を root に修正（Windowsは修正不要）

    ```INI
    DB_PASSWORD=root
    ```

* APP_KEY生成

    ```console
    php artisan key:generate
    ```

* Composerインストール

    ```console
    composer install
    ```

* フロント環境構築

    ```console
    npm ci
    npm run build
    ```

* マイグレーション

    ```console
    php artisan migrate
    ```

* 起動

    ```console
    php artisan serve
    ```
