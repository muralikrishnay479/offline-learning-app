attempt.php

<?php
session_start();
$quizData = json_decode(file_get_contents('quiz_data.json'), true) ?? [];
$scoresFile = 'scores.json';
$scoresData = json_decode(file_get_contents($scoresFile), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_SESSION['user'] ?? 'Guest';
    $userAnswers = $_POST['answer'] ?? [];
    $score = 0;
    $total = count($quizData);

    foreach ($quizData as $index => $quiz) {
        if (isset($userAnswers[$index]) && $userAnswers[$index] == $quiz['answer']) {
            $score++;
        }
    }

    // Store score in scores.json
    $scoresData[] = [
        'username' => $user,
        'attempted' => $total,
        'score' => $score
    ];
    file_put_contents($scoresFile, json_encode($scoresData, JSON_PRETTY_PRINT));

    header("Location: useranalysis.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attempt Quiz</title>
</head>
<body>
    <h2>Attempt Quiz</h2>
    <form method="post">
        <?php foreach ($quizData as $index => $quiz) : ?>
            <p><strong><?php echo $quiz['question']; ?></strong></p>
            <?php foreach ($quiz['options'] as $key => $option) : ?>
                <label>
                    <input type="radio" name="answer[<?php echo $index; ?>]" value="<?php echo $key + 1; ?>" required>
                    <?php echo $option; ?>
                </label>
                <br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Submit Quiz">
    </form>
</body>
</html>