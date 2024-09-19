<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hero'], $_POST['setting'], $_POST['first_scene'], $_POST['choice1_text'], $_POST['choice2_text'])) {
        // 物語のデータを保存
        $hero = htmlspecialchars($_POST['hero'], ENT_QUOTES, 'UTF-8');
        $setting = htmlspecialchars($_POST['setting'], ENT_QUOTES, 'UTF-8');
        $first_scene = htmlspecialchars($_POST['first_scene'], ENT_QUOTES, 'UTF-8');
        $choice1_text = htmlspecialchars($_POST['choice1_text'], ENT_QUOTES, 'UTF-8');
        $choice2_text = htmlspecialchars($_POST['choice2_text'], ENT_QUOTES, 'UTF-8');

        // データの保存ファイル名を決定
        $filename = 'stories/' . uniqid() . '.json';

        // 保存するデータを配列として準備
        $data = [
            'hero' => $hero,
            'setting' => $setting,
            'first_scene' => $first_scene,
            'choices' => [
                'choice1' => $choice1_text,
                'choice2' => $choice2_text
            ]
        ];

        // データをJSON形式で保存
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
        if ($json_data === false) {
            echo "データのJSONエンコードに失敗しました。";
            exit;
        }

        if (file_put_contents($filename, $json_data) !== false) {
            // データ保存に成功した場合、read2.phpにリダイレクト
            header("Location: read2.php?file=" . urlencode(basename($filename)));
            exit;
        } else {
            echo "物語の保存に失敗しました。";
        }
    } elseif (isset($_POST['file'], $_POST['rating'])) {
        // 評価データの保存
        $file = basename($_POST['file']); // 安全性を考慮して basename() を使用
        $rating = intval($_POST['rating']);
        $rating_file = 'ratings/' . basename($file, '.json') . '_ratings.json';

        // 保存するデータを配列として準備
        $rating_data = [
            'rating' => $rating
        ];

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

        // 評価データをJSON形式で保存
        $json_rating_data = json_encode($existing_ratings, JSON_UNESCAPED_UNICODE);
        if ($json_rating_data === false) {
            echo "評価データのJSONエンコードに失敗しました。";
            exit;
        }

        if (file_put_contents($rating_file, $json_rating_data) !== false) {
            // index2ページにリダイレクト
            header("Location: index2.php");
            exit;
        } else {
            echo "評価データの保存に失敗しました。";
        }
    } else {
        echo "無効なリクエストです。";
    }
} else {
    echo "無効なリクエストメソッドです。";
}
?>
