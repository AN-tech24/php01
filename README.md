①課題番号-プロダクト名
7-『あなたもストーリーテラー　物語評価システム』

②課題内容（どんな作品か）
ユーザーが物語を作って、それに評価をつけられるシステムです。
【処理の流れ】
1.index2.phpで物語を作成し、ユーザーが入力したデータを write2.phpにPOSTする。
2.write2.phpではPOSTされたデータをサニタイズなどセキュリティ対策をとりつつ、storiesフォルダに一意のIDをもつファイルとして保存する。
データの保存が成功すると、read2.phpにリダイレクトされ、その際にファイル名をGETパラメータとして渡す。（例：read2.php?file=abc123.json）
3.read2.phpでは、write2.phpで保存した物語ファイルを読み込み、その内容を表示する。また、ユーザーが物語を評価するための評価フォームがある。
評価が送信されると、評価データはcomplete.phpにPOSTされる。
4.complete.phpでは評価データの受け取り保存と一覧表示
read2.phpからPOSTリクエストで受け取った評価データ（ファイル名と評価値）を処理する。評価はratingsフォルダに一意のIDをもつファイルとして保存する。既存の評価データがあればそれに追加する。
また、物語一覧を表示し、各物語に対しての評価も行える。

~~index2.php で物語を作成し、write2.php で保存します。その後、read2.php で物語を見ながら評価できるようにして、
評価は top_rated.php で集計してトップ評価の物語、つまり良い評価の物語をランキング形式で見られるようにしたかったです。~~
(学長が紹介してくださったサイトにインスピレーションを得ました）

③DEMO
[(https://gsdeploy.sakura.ne.jp/php01/index2.php
)

④作ったアプリケーション用のIDまたはPasswordがある場合
ID: 〇〇〇〇〇〇〇〇
PW: 〇〇〇〇〇〇〇〇
⑤工夫した点・こだわった点
-
-使いやすさでは、以下の点にこだわりました。
物語の情報が見やすく表示されること。なるべくユーザの入力を減らし、選択式にできるようにした。
~~評価ボタンを read2.php に追加して、ユーザーがスムーズに評価できるようにしました。~~
-データ管理でこだわった点としては、物語と評価はJSON形式で保存して、データの整合性を保つようにした。
例えば、物語の保存では、$filename = 'stories/' . uniqid() . '.json';
と、保存するファイル名を一意の ID で決定し、stories フォルダに JSON ファイルとして保存するようにした。
~~-評価の表示では、
top_rated.php で評価を集計し、物語を評価順に並べて表示するようにしました。これで、ユーザーのモチベーションにつながるはずです。~~
・***評価の表示がうまくいかないときがあったので、complete.phpでフォルダが存在しない場合は作成すること/read2.phpでは既存評価データの読み込みを行ってから評価データの取り込みをした。***
具体的には、以下の文を追加した。
    // ratings/ フォルダが存在しない場合は作成
    if (!file_exists('ratings')) {
        mkdir('ratings', 0777, true);
    }
     // 既存の評価データを読み込み、追加
        $existing_ratings = [];
        if (file_exists($rating_file)) {
            $existing_ratings = json_decode(file_get_contents($rating_file), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "評価データのJSONデコードに失敗しました。";
                exit;
            }
        }
        $existing_ratings[] = $rating_data;
評価自体は、{"rating":3},{"rating":4}]のようなかたちでJSONファイルに格納し、既存の評価データも読み込めるようにした。



⑥難しかった点・次回トライしたいこと(又は機能)
-★データ保存のトラブル:★
「file_exists」や「file_get_contents」でエラーが出ることが多くて、かなり手こずりました。
何度も何度もファイルパスが間違ってるんのでは？と何度も確認しましたが、それでもうまくいかないことがあって。エラーが出るたびに悩んでいた。
改善方法を知りたい。
***phpに記入しているコード自体は正しくても、作成途中でつくられていたJSONファイルの定義がうまくいかず、下のようなエラーが一部出ていた。***
Warning: Undefined array key "hero" in C:\xampp\htdocs\php01\complete.php on line 68
Warning: Undefined array key "setting" in C:\xampp\htdocs\php01\complete.php on line 69
ここで問題となっているJSONファイルを削除することで、解決できたが、エラーの箇所を探すのに時間がかかった。
~~データ表示の問題:
「top_rated.php」で評価データがちゃんと表示されないことが多く、これもなかなか手強かった。
評価が集まらないのも困ったし、どうやって正しく表示するかも考えながら進めていた。~~


-次回トライしたいこと:
-ユーザーインターフェースの改善: ずっと課題のままであるが、少しずつ良くなってきている気がする。
-評価のフィードバック機能: 評価したユーザーに対して、フィードバックやコメントを送れるようにする機能をつけたら、よりインタラクティブなやり取りができそう。
-データの分析: 物語の評価データをもっと深く分析して、どんな物語が人気かとか、ユーザーの好みを把握するための機能も追加できたら、より評価の高いものになりそう。
[質問]
データの保存が成功すると、read2.phpにリダイレクトされ、その際にファイル名をGETパラメータとして渡す仕様にしていたのですが、
これもPOSTした方がよかったのか考えております。特に意味をもたない、一意のIDが表示されてしまうことに問題はあるのでしょうか？講義で行ったようにひたすらPOSTがいいですかねぇ。
//read2.phpから送る評価データと物語データはPOSTしています。

[感想]
・php01での課題であり、データベースを本格的に学ぶ前だったこともあり、物語データの表示保存と、評価データの表示保存で混乱があった。
→物語のデータと評価のデータを別々に保存することで解決しました！！
今ならば、権限によってまさに他者の評価データを確認できるか、等の仕様を変更するというアイデアがある。
アイデアと、その実現への方法のいくつか、をTechの営みを通して学べている。
[参考記事]GitHub 上で取り消し線などの表示の仕方↓
[https://docs.github.com/ja/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax]
[URLをここに記入]
