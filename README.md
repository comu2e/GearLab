## GearLab について

GearLabはキャンプを充実させるキャンプギアを共有できるサイトです。

## 概要　-Concept - 

 自分にあったキャンプギアの準備で困ったことはないでしょうか？
 
 友達やキャンプ場であった他の人の道具、 
 
 はたまたYoutubeで気になる道具を見つけ出した経験はあるでしょう。
 
 このサイトではすでにキャンプをしている人、始めたいと思う人にとって、
 自分にあうキャンプ道具をみつけていくことを手助けして、よりキャンプライフを
 楽しくするでしょう。
## :alarm_clock: 作製期間

2020年12月からすべて**独学**で制作しています。


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
- 管理者機能

### その他

- git 2.24.3
- Linux基礎コマンド
- Github (Pull Request, Issues を使用)

## こだわった点
- バックエンドではAPIの導入
- スムーズな遷移を実現するために、Vue.jsを使ったSPA化


## :computer: 使用技術
 ### バックエンド
  - PHP 7.3.11 /Laravel 8.13.0 
 ### フロントエンド
        
  - javascript/ Vue.js (2.6.12) /Vuex/ Vue Router 
 
 ### インフラ 

  - Docker  
  - AWS ECS(EC2) / VPC / Route53/ ALB / ACM / S3 / RDS /Cloudwatch
  **本番環境**
 
     - AWS(詳細はネットワーク構成図参照)
         - RDS for MySQL8.0
         - Nginx 2.0.3

 
 ## :cloud:ネットワーク構成図
  ![AWS](https://user-images.githubusercontent.com/5231283/104843022-eb2c6680-590b-11eb-95b2-7077c0aafeb3.jpg)


