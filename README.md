## GearLab について

GearLabはキャンプを充実させるキャンプギアを共有できるサイトです。
<img src="https://user-images.githubusercontent.com/5231283/106913101-00e0bf00-6747-11eb-8499-d7fa8046f721.gif" width="800" height="800" />
## :earth_asia: 概要

- **キャンプ道具（Gear:ギア）を発見する手助けするwebアプリ**です。
- 他の人が使っているギアを参考にして使ってみたいギアを発見することで**自分にあったキャンプ生活を良くしていくことを目的**としました。
- **Laravel/Vue.js**を使い、SPA化しています。
- 2020年12月の**2ヶ月間で０から公開できるレベルを目標**として制作しています。

## :bulb: 作成経緯


- **キャンプブームの再興**

   コロナ禍によってキャンプブームが再び広がっています。
   
- **キャンプを始める障害**
自分にあったキャンプギアの準備で困ったことはないでしょうか？友達やキャンプ場であった他の人の道具、 はたまたYoutubeで気になる道具を見つけ出した経験はあるでしょう。
 私自身、キャンプを始める際に友人、Youtube,店舗などで自分にあるギアを見つけてきましたが、本当に自分にあうギアを揃えるまでに時間とお金がかかってしまいました。 
   
 - **このアプリで達成したいこと**

 このサイトではすでにキャンプをしている人、始めたいと思う人にとって、
 自分にあうキャンプ道具をみつけていくことを手助けして、よりキャンプライフを
 楽しくする事ができるようにしたいと思っています。



## :alarm_clock: 作製期間

2020年12月からすべて独学で制作しています。

## :notebook: 学習方法
1. PHPの基礎からポートフォリオの作成までの５ヶ月間、業務終了後18：00以降から23:00まで毎日5時間学習すると決めて実践してきました。
2. **経験のアウトプットも行っています**。
  微力ではありますが、気づいたことなどを発信するようにしています。
    [@comu2eのマイページ - Qiita](https://qiita.com/comu2e)


## :wrench:機能

- ギアの投稿機能
- ギアの編集・削除機能
- カテゴリ検索機能
- タイムライン表示機能
- いいね機能　
- フォロー機能
- いいねしたギアの表示機能
- フォローユーザ　一覧表示機能
- ページネーション機能
- 管理者機能(ユーザーの一覧表示とユーザーの削除)
- 画像クリック時拡大機能
- 参考にしたサイト投稿機能　(ユーザーが貼ったURLにリンクが自動で作製されるようにしています。）
### その他

- git 2.24.3
- Linux基礎コマンド
- Github (Pull Request, Issues を使用)

## :rainbow: こだわった点
- バックエンドではAPIの導入
- テストコードの学習 : phpunitでfeatureテスト,dusk使用してブラウザテストしています。
- N+1問題への対処
- スムーズな遷移を実現するために、Vue.jsを使ったSPA化
- スムーズに保守開発できるようにするために、github-actionsでのCI/CDパイプライン構築しました。
- Docker/AWSの使用
## :computer: 使用技術
 ### バックエンド
  - PHP 7.3.12 /Laravel 8.13.0
  - composer 2.0.6
 ### フロントエンド
        
  - javascript/ Vue.js (2.6.12) /Vuex/ Vue Router 
 
 ### インフラ 

  - Docker  
  - AWS EC2/ ECR / VPC / Route53/ ALB / ACM / S3 / RDS /Cloudwatch
  - github actionsでのCI/CDパイプライン
  
 ## 本番環境
 
     - AWS(詳細はネットワーク構成図参照)
         - RDS for MySQL8.0
         - Nginx 2.0.3

## 今後の開発予定
　- php,vue.jsテストの追加
  - バックパック機能の追加　... シチュエーション別で使用しているギアをセットにして保存する機能：自分が使っているギアのセットを紹介したいときに使う機能
 
 ## :cloud:ネットワーク構成図

![Untitled Diagram](https://user-images.githubusercontent.com/5231283/106886891-c156aa80-6727-11eb-826c-4f68100a5a9b.jpg)

## :straight_ruler:ER構成図
![eq2](https://user-images.githubusercontent.com/5231283/106887394-70938180-6728-11eb-9ec0-bf58d969a985.png)
