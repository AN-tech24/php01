<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>あなたのがつくるストーリー</title>
    <style>
        /* 全体のデザイン設定 */
        body {
            font-family: 'Arial', sans-serif; /* フォント設定 */
            background-color: #f7f9fc; /* 背景色 */
            color: #333; /* テキストの色 */
            margin: 0;
            padding: 0;
            display: flex; /* フレックスボックスで中央配置 */
            justify-content: center; /* 水平方向の中央揃え */
            align-items: center; /* 垂直方向の中央揃え */
            min-height: 100vh; /* ビューポートの最小高さに合わせる */
            box-sizing: border-box; /* パディングとボーダーを含めて高さを計算 */
            overflow: auto; /* 内容が画面を超えた場合にスクロール */
        }

        /* フォームコンテナのスタイル */
        .container {
            background: #fff; /* 背景色 */
            border-radius: 8px; /* 角の丸み */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ボックスシャドウ */
            padding: 20px; /* 内部の余白 */
            max-width: 100%; /* 最大幅を100%に設定 */
            width: 90%; /* 幅を90%に設定 */
            max-width: 800px; /* 最大幅を800pxに設定 */
            box-sizing: border-box; /* パディングとボーダーを含めて幅を計算 */
            margin: 0 auto; /* 左右のマージンを自動設定（中央揃え） */
        }

        /* タイトルのスタイル */
        h1 {
            text-align: center; /* 中央揃え */
            color: #4CAF50; /* テキストの色 */
            margin-bottom: 20px; /* 下部のマージン */
        }

        /* ラベルのスタイル */
        label {
            display: block; /* ブロック要素として表示 */
            margin-bottom: 5px; /* 下部のマージン */
            font-weight: bold; /* 太字 */
            color: #555; /* テキストの色 */
        }

        /* 入力フィールドのスタイル */
        select, input, textarea {
            width: calc(100% - 22px); /* 幅を100%からパディングを引いたサイズに設定 */
            padding: 10px; /* 内部の余白 */
            margin-bottom: 15px; /* 下部のマージン */
            border: 1px solid #ddd; /* ボーダー */
            border-radius: 4px; /* 角の丸み */
            box-sizing: border-box; /* パディングとボーダーを含めて幅を計算 */
        }

        /* テキストエリアのリサイズ設定 */
        textarea {
            resize: vertical; /* 垂直方向のリサイズを許可 */
        }

        /* ボタンのスタイル */
        button {
            display: block; /* ブロック要素として表示 */
            width: 100%; /* 幅を100%に設定 */
            padding: 10px; /* 内部の余白 */
            background-color: #4CAF50; /* 背景色 */
            color: white; /* テキストの色 */
            border: none; /* ボーダーなし */
            border-radius: 4px; /* 角の丸み */
            cursor: pointer; /* ポインタカーソルに設定 */
            font-size: 16px; /* フォントサイズ */
        }

        /* ボタンのホバー時のスタイル */
        button:hover {
            background-color: #45a049; /* ホバー時の背景色 */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>物語を作成しよう</h1>

    <!-- フォームの開始 -->
    <form action="write2.php" method="post">
        <label for="hero">主人公の名前:</label>
        <select id="hero" name="hero" required>
            <option value="">選択してください</option>
            <option value="太郎">太郎</option>
            <option value="花子">花子</option>
            <option value="勇者">勇者</option>
            <option value="姫">姫</option>
            <option value="魔法使い">魔法使い</option>
            <option value="騎士">騎士</option>
            <option value="忍者">忍者</option>
            <option value="冒険者">冒険者</option>
            <option value="精霊">精霊</option>
            <option value="妖精">妖精</option>
        </select>

        <label for="setting">物語の背景・設定:</label>
        <select id="setting" name="setting" required>
            <option value="">選択してください</option>
            <option value="中世の城">中世の城</option>
            <option value="未来の都市">未来の都市</option>
            <option value="魔法の森">魔法の森</option>
            <option value="宇宙ステーション">宇宙ステーション</option>
            <option value="海底都市">海底都市</option>
            <option value="古代遺跡">古代遺跡</option>
            <option value="荒野">荒野</option>
            <option value="妖精の村">妖精の村</option>
            <option value="地下洞窟">地下洞窟</option>
            <option value="異世界">異世界</option>
        </select>

        <label for="first_scene">最初のシーン:</label>
        <select id="first_scene" name="first_scene" required>
            <option value="">選択してください</option>
            <option value="いつも通りの朝だった">いつも通りの朝だった</option>
            <option value="その日、隕石が落ちてきた">その日、隕石が落ちてきた</option>
            <option value="雨が７日間続いた">雨が７日間続いた</option>
            <option value="村の広場で奇妙な音が響いた">村の広場で奇妙な音が響いた</option>
            <option value="街の灯りが一斉に消えた">街の灯りが一斉に消えた</option>
            <option value="主人公が迷子になった">主人公が迷子になった</option>
            <option value="不思議な生物が現れた">不思議な生物が現れた</option>
            <option value="突然の大地震が発生した">突然の大地震が発生した</option>
            <option value="星空に奇妙な星座が現れた">星空に奇妙な星座が現れた</option>
            <option value="謎の手紙が届いた">謎の手紙が届いた</option>
        </select>

        <label for="choice1_text">選択肢1:</label>
        <select id="choice1_text" name="choice1_text" required>
            <option value="">選択してください</option>
            <option value="主人公は外に出て調べに行く">主人公は外に出て調べに行く</option>
            <option value="主人公はその場でじっと待つ">主人公はその場でじっと待つ</option>
            <option value="村の長老に相談する">村の長老に相談する</option>
            <option value="一緒にいる友達に話す">一緒にいる友達に話す</option>
            <option value="家に戻って準備をする">家に戻って準備をする</option>
            <option value="情報を集めるために街に出る">情報を集めるために街に出る</option>
        </select>

        <label for="choice2_text">選択肢2:</label>
        <select id="choice2_text" name="choice2_text" required>
            <option value="">選択してください</option>
            <option value="主人公は状況を調べるために探索に出る">主人公は状況を調べるために探索に出る</option>
            <option value="主人公は他の人と協力する">主人公は他の人と協力する</option>
            <option value="主人公は自分の感覚を信じて行動する">主人公は自分の感覚を信じて行動する</option>
            <option value="主人公は疑わしい場所を調査する">主人公は疑わしい場所を調査する</option>
            <option value="主人公は手掛かりを集めるために質問する">主人公は手掛かりを集めるために質問する</option>
            <option value="主人公は事態を解決するために計画を立てる">主人公は事態を解決するために計画を立てる</option>
        </select>

        <button type="submit">物語を保存</button>
    </form>
</div>

</body>
</html>
