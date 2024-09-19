<?php
if (isset($_GET['file'])) {
    $file = basename($_GET['file']); // セキュリティ対策として basename を使用
    $filepath = 'stories/' . $file; // フルパスを作成

    // ファイルの存在チェック
    if (file_exists($filepath)) {
        // ファイルの内容を読み込む
        $json_data = file_get_contents($filepath);
        
        if ($json_data !== false) {
            // JSONデータをデコード
            $data = json_decode($json_data, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // データを表示する
                echo "<h1>物語</h1>";
                echo "<p>ヒーロー: " . htmlspecialchars($data['hero'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p>設定: " . htmlspecialchars($data['setting'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p>最初のシーン: " . htmlspecialchars($data['first_scene'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p>選択肢1: " . htmlspecialchars($data['choices']['choice1'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p>選択肢2: " . htmlspecialchars($data['choices']['choice2'], ENT_QUOTES, 'UTF-8') . "</p>";
            } else {
                echo "データのJSONデコードに失敗しました。";
            }
        } else {
            echo "ファイルの読み込みに失敗しました。";
        }
    } else {
        echo "指定されたファイルが存在しません。";
    }
} else {
    echo "ファイルが指定されていません。";
}
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