# Instagram Clone

## 1. このアプリの概要
これは、侍エンジニア塾のカリキュラムの中で、PHPで学んだMVCモデルと、Laravelの基本的な仕組みを理解するためにインスタグラムを参考に開発したアプリになります。
内容としては、ユーザーが会員登録し、プロフィールを作成したり、画像投稿をしたりしていく流れになっております。
どのような写真が投稿されているかが、より分かるようにするため最初のトップ画面に投稿された画像が表示されるように工夫しました。
また、投稿にいいねしたり、検索したりできる機能もあります。
また、タイムライン(自分が投稿した一覧)、お気に入り投稿(自分がいいねした投稿一覧)、いいねランキング一覧のコンテンツも加えています。
実際にエンジニアの知り合いに紹介して、Laravelの基本的な機能がしっかり盛り込まれていることを評価していただいたり、家族や友人にも使ってもらうこともあります。
Herokuにデプロイしているので、よろしければこちらをご覧くださり、ぜひ、実際に操作していただきたいです。

## 2. 技術要素

- 開発環境 AWS Cloud9 / Amazon Linux AMI
- HTML5 / CSS3
- Bootstrap 4.3.1
- JavaScript / jQuery 3.3.1
- PHP 7.2.34
- MySQL 5.5.62
- Laravel Framework 5.8.38
- 画像の保存 AWS / S3
- バージョン管理 Git / GitHub
- PHPUnit(テストした内容は会員登録、ログインのみ)
- デプロイ Heroku

##### ※以下のダミーユーザーを使ってログインしてご利用ください。
- 名前: 侍 太郎
- メールアドレス: samurai@gmail.com
- パスワード: samurai

## 2. 機能一覧
#### (1) ユーザー関連
- パスワード付きユーザー登録機能
- ログイン・ログアウト機能
- ユーザーのプロフィールの登録・編集機能
- ユーザー一覧表示機能
- ユーザーのプロフィール詳細表示機能
- ユーザーのフォロー追加・解除機能
- ユーザーのフォロー一覧表示機能
- ユーザーのフォローワー一覧表示機能

#### (2) 投稿関連
- 投稿一覧表示機能
- 投稿検索機能
- 投稿詳細表示機能
- 新規画像投稿機能
- 画像投稿編集・削除機能
- 投稿にコメントする機能
- 投稿にいいね追加・解除機能
- タイムライン表示機能
- お気に入り投稿(自分がいいねした投稿)一覧表示機能
- いいね投稿ランキング表示機能

#### (3) その他
- 各種フラッシュメッセージ表示機能
- 各種入力値に関するバリデーション機能
- 不正アクセス防止機能

## 3. このアプリの画像資料
※コンテンツが多いため一部を紹介いたします。

##### ⓵最初の画面
![最初の画面](/public/images/sample_1.jpg)

##### ⓶ログイン後のトップ画面
![ログイン後のトップ画面(投稿一覧) ](/public/images/sample_2.jpg)

##### ⓷ユーザーのプロフィール画面
![職員プロフィール](/public/images/sample_3.jpg)

##### ⓸投稿の詳細画面
![投稿の詳細画面](/public/images/sample_4.jpg)

##### ⓹いいね投稿ランキング画面
![いいね投稿ランキング](/public/images/sample_5.jpg)

##### ⓺このアプリのデータベース図
![このアプリのデータベース図](/public/images/instagram_database.jpg)

## 4. お問い合わせ
駆け出しエンジニアの立場で、まだまだ不勉強なためバグが潜んでいるかもしれません。
改善点などがありましたら、以下のメールアドレスにご連絡いただけると幸いです。

##### ◆メールアドレス:
samurai.portfolio@gmail.com

また、自作のポートフォリオサイトもありますので、よろしければこちらもご覧ください。

##### ◆Kazuma Iwaiのポートフォリオサイト:
http://ksamurai.php.xdomain.jp/Portfolio/index.php

## 著者
2022/06/10 Kazuma Iwai