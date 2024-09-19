<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物語一覧</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            width: 90%;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        select, button {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>作成した物語の一覧</h1>
    <ul>
        <?php
        // 物語のファイルを取得
        $story_files = glob('stories/*.json');
        $stories = [];

        foreach ($story_files as $file) {
            $json_data = file_get_contents($file);
            if ($json_data !== false) {
                $data = json_decode($json_data, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $stories[] = [
                        'file' => basename($file),
                        'hero' => htmlspecialchars($data['hero'], ENT_QUOTES, 'UTF-8'),
                        'setting' => htmlspecialchars($data['setting'], ENT_QUOTES, 'UTF-8'),
                        'first_scene' => htmlspecialchars($data['first_scene'], ENT_QUOTES, 'UTF-8')
                    ];
                }
            }
        }

        foreach ($stories as $story): ?>
            <li>
                <h2><?php echo $story['hero']; ?>の物語</h2>
                <p>設定: <?php echo $story['setting']; ?></p>
                <p>最初のシーン: <?php echo $story['first_scene']; ?></p>
                <a href="read2.php?file=<?php echo urlencode($story['file']); ?>">物語を読む</a>
                <form action="complete.php" method="post">
                    <input type="hidden" name="file" value="<?php echo $story['file']; ?>">
                    <label for="rating_<?php echo $story['file']; ?>">評価:</label>
                    <select name="rating" id="rating_<?php echo $story['file']; ?>" required>
                        <option value="">選択してください</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit">評価を送信</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php
    // 評価データの保存処理
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['file'], $_POST['rating'])) {
        $file = basename($_POST['file']);
        $rating = intval($_POST['rating']);
        $rating_file = 'ratings/' . basename($file, '.json') . '_ratings.json';


    // ratings/ フォルダが存在しない場合は作成
    if (!file_exists('ratings')) {
        mkdir('ratings', 0777, true);
    }

    

    // 既存の評価データを読み込み、追加
        // 保存するデータを配列として準備
        $rating_data = ['rating' => $rating];

        // 既存の評価データを読み込み、追加
        $existing_ratings = [];
        if (file_exists($rating_file)) {
            $existing_ratings = json_decode(file_get_contents($rating_file), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "<p>評価データのJSONデコードに失敗しました。</p>";
                exit;
            }
        }
        $existing_ratings[] = $rating_data;

        // 評価データをJSON形式で保存
        $json_rating_data = json_encode($existing_ratings, JSON_UNESCAPED_UNICODE);
        if ($json_rating_data === false) {
            echo "<p>評価データのJSONエンコードに失敗しました。</p>";
            exit;
        }

        if (file_put_contents($rating_file, $json_rating_data) !== false) {
            echo "<p>評価が保存されました。</p>";
        } else {
            echo "<p>評価データの保存に失敗しました。</p>";
        }
    }
    ?>
</div>
?>
</pre> 
<!-- プレーンテキストをそのままの形式で表示するためにpreタグをつかった -->

<!-- index2.php に戻るためのボタン -->
<form action="index2.php" method="get">
    <button type="submit">戻る</button>
</form>
</div>

</body>
</html>
