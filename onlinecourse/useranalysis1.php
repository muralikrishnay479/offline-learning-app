<?php
session_start();

$scoresFile = 'scores.json';
$quizData = json_decode(file_get_contents('C:\xampp\htdocs\onlinecourse\admin\quiz_data.json'), true) ?? [];
$scoresData = json_decode(file_get_contents('C:\xampp\htdocs\onlinecourse\admin\scores.json'), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userAnswers = $_POST['answer'] ?? [];
    $score = 0;
    $total = count($quizData);

    foreach ($quizData as $index => $quiz) {
        if (isset($userAnswers[$index]) && $userAnswers[$index] == $quiz['answer']) {
            $score++;
        }
    }

    $scoresData[$user] = [
        'username' => $user,
        'attempted' => $total,
        'score' => $score
    ];

    file_put_contents($scoresFile, json_encode($scoresData, JSON_PRETTY_PRINT));
    header("Location: score_analysis.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Score Analysis</title>
</head>
<body>
    <h2>Score Analysis</h2>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Quiz Attempted</th>
            <th>Marks Scored</th>
        </tr>
        <?php foreach ($scoresData as $score) : ?>
            <tr>
                <td><?php echo $score['username']; ?></td>
                <td><?php echo $score['attempted']; ?></td>
                <td><?php echo $score['score']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>