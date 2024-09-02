<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 物語のデータを保存
    if (isset($_POST['hero'], $_POST['setting'], $_POST['first_scene'], $_POST['choice1_text'], $_POST['choice2_text'])) {
        $hero = htmlspecialchars($_POST['hero']);
        $setting = htmlspecialchars($_POST['setting']);
        $first_scene = htmlspecialchars($_POST['first_scene']);
        $choice1_text = htmlspecialchars($_POST['choice1_text']);
        $choice2_text = htmlspecialchars($_POST['choice2_text']);

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
        if (file_put_contents($filename, json_encode($data, JSON_UNESCAPED_UNICODE))) {
            // データ保存に成功した場合、read2.phpにリダイレクト
            header("Location: read2.php?file=" . urlencode(basename($filename)));
            exit;
        } else {
            echo "物語の保存に失敗しました。";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['file'], $_POST['rating'])) {
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
    }
    $existing_ratings[] = $rating_data;

    // 評価データをJSON形式で保存
    file_put_contents($rating_file, json_encode($existing_ratings, JSON_UNESCAPED_UNICODE));

    // トップ評価ページにリダイレクト
    header("Location: top_rated.php");
    exit;
} else {
    echo "無効なリクエストです。";
}
?>
