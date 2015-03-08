# ユーザープロフィールディスプレイ プラグイン
ユーザープロフィールディスプレイ プラグインは、ユーザー別にプロフィール情報を設定できるbaserCMS専用のプラグインです。


## Installation
1. 圧縮ファイルを解凍後、BASERCMS/app/Plugin/UserProfileDisplay に配置します。
2. 管理システムのプラグイン管理に入り、表示されている ユーザープロフィールディスプレイ プラグイン を有効化して下さい。
3. プラグインのインストール後、ユーザー情報編集画面にアクセスすると、公開用プロフィール設定項目が追加されてます。


## Uses
- ユーザー別のユーザー情報編集画面で、プロフィール情報の入力ができます。
- プロフィール用画像は、画像アップロード or Gravatar 表示を選択できます。
- ブログ記事表示を「表示する」にすると、記事の作成者が作成した最新記事を表示します。


### Uses Theme
- 以下のファイルをテーマ側にコピーします。
  - /Plugin/UserProfileDisplay/View/Elements/user_profile_display_block.php
- ブログの記事詳細用のビュー（/theme/THEME/Blog/default/single.php）に、以下の内容を記載することで表示できます。

```
<?php $this->BcBaser->element('user_profile_display_block') ?>
```


## Thanks
- [http://basercms.net/](http://basercms.net/)
- [http://wiki.basercms.net/](http://wiki.basercms.net/)
- [http://cakephp.jp](http://cakephp.jp)
- [https://ja.gravatar.com/](https://ja.gravatar.com/)
