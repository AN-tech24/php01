<?php
$stories_dir = 'stories/';
$ratings_dir = 'ratings/';

// 物語ファイルのリストを取得
$stories = array_filter(scandir($stories_dir), function($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'json';
});

// 評価を集計する配列
$ratings = [];

// 物語ごとに評価を集計
foreach ($stories as $story_file) {
    $story_id = basename($story_file, '.json');
    $rating_file = $ratings_dir . $story_id . '_ratings.json';

    if (file_exists($rating_file)) {
        $story_ratings = json_decode(file_get_contents($rating_file), true);
        $average_rating = 0;
        $rating_count = count($story_ratings);

        foreach ($story_ratings as $rating) {
            $average_rating += $rating['rating'];
        }
        $average_rating /= $rating_count;

        $story_data = json_decode(file_get_contents($stories_dir . $story_file), true);

        $ratings[$story_file] = [
            'average_rating' => $average_rating,
            'username' => $story_data['username'],
            'email' => $story_data['email']
        ];
    }
}

// 評価が高い順にソート
uasort($ratings, function($a, $b) {
    return $b['average_rating'] <=> $a['average_rating'];
});
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップ評価物語</title>
    <style>
        /* CSSスタイルはここに記載 */
    </style>
</head>
<body>
<div class="container">
    <h1>トップ評価物語</h1>
    <table>
        <thead>
            <tr>
                <th>物語</th>
                <th>評価</th>
                <th>作成者</th>
                <th>メールアドレス</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ratings as $file => $data): ?>
            <tr>
                <td>
                    <a href="read2.php?file=<?php echo htmlspecialchars(basename($file)); ?>">
                        <?php echo htmlspecialchars(basename($file)); ?>
                    </a>
                </td>
                <td><?php echo number_format($data['average_rating'], 1); ?></td>
                <td><?php echo htmlspecialchars($data['username']); ?></td>
                <td><?php echo htmlspecialchars($data['email']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
