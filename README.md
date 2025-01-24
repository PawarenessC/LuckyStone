# LuckyStone
## PMMPのサーバー内で石を掘るとたまに鉱石がでてくる^_^

### 設定ファイルの説明
#### Setup.yml 

項目 | 初期値 | 説明
--- | --- | ---
iron_rand_max | 10 | 鉄インゴットが出る確率の最大値
number_of_iron_max | 10 | 確率当選時、鉄インゴットが出てくる数の最大値
diamond_rand_max | 10 | ダイアモンドが出る確率の最大値
number_of_diamond_max | 10 | 確率当選時、鉄インゴットが出てくる数の最大値
double_drop | true | 鉄とダイアが同時にドロップすることを許可するか
Priority_given_to_diamonds | true | double_dropが不許可(false)だった場合、ダイアを優先(true)してドロップさせる。鉄優先であればfalse

#### Message.yml
項目 | 説明
--- | ---
send_message | それぞれのドロップ時にプレイヤーにメッセージを送るか。 trueで送信。falseで送信しない。
drop.iron | 鉄だけドロップしたときのメッセージ
drop.diamond | ダイアモンドだけドロップしたときのメッセージ
drop.both | 鉄とダイア両方ドロップしたときのメッセージ

### ToDoリスト
- [ ] UIか何かで直接的に設定できるようにする
- [ ] 石以外にも対応 
- [ ] 経済プラグインとの連携(不明)
      
### 連絡先
Discord .hAnyu
X(旧Twitter) @12345_awa
