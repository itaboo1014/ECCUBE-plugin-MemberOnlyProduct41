# 会員限定商品プラグイン(4.1系)

このプラグインを使用することで、会員登録しているユーザーのみが購入できる商品を設定できるようになります。

また、商品一覧ページで会員限定商品の並び替えができるようになり、必要に応じて並び替えのタイトルやカート追加失敗時のエラーメッセージの設定が可能です。

## 導入方法

- 当プラグインをインストール＆有効化してくだい。
- `管理画面` ＞ `コンテンツ管理` ＞ `キャッシュ管理` より、`キャッシュ削除` を行なってください。
- `管理画面` ＞ `商品管理` の各商品登録・編集ページより、必要に応じて会員限定商品を設定してください。
- `管理画面` ＞ `オーナーズストア` ＞ `プラグイン一覧` ＞ `会員限定商品プラグイン(4.1系)` の設定（歯車アイコン）より、並び替えタイトルと表示メッセージを必要に応じて設定してください。
- 再度 `管理画面` ＞ `コンテンツ管理` ＞ `キャッシュ管理` より、`キャッシュ削除` を行なってください。

*カスタマイズを行なっている際は正常に動作しない可能性がございます。

<a href="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/1.png"><img src="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/1.png"></a>
<a href="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/2.png"><img src="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/2.png"></a>
<a href="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/3.png"><img src="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/3.png"></a>
<a href="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/4.png"><img src="https://raw.githubusercontent.com/itaboo1014/ECCUBE-PluginReadmeAsset/main/MemberOnlyProduct/4.png"></a>


## ステータス変更時の処理

### インストール時
- DB テーブル `plg_member_only_product_config` を作成
- DB テーブル `dtb_product` に `only_member` カラムを作成
### アップデート時
- なし
### 有効化時
- 初期データの登録
  - 会員限定商品:false
  - DB テーブル `mtb_product_list_order_by` に会員限定商品用のレコードを追加
### 無効化時
- なし
- DB テーブル `mtb_product_list_order_by` の会員限定商品用のレコードを削除
### アンインストール時
- DB テーブル `plg_member_only_product_config` を削除
- DB テーブル `dtb_product` の `only_member` カラムを削除
