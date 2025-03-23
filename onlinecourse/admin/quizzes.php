add_quiz.php

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quizData = json_decode(file_get_contents('quiz_data.json'), true) ?? [];
    
    $newQuiz = [
        'question' => $_POST['question'],
        'options' => [$_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option4']],
        'answer' => $_POST['answer']
    ];
    
    $quizData[] = $newQuiz;
    file_put_contents('quiz_data.json', json_encode($quizData, JSON_PRETTY_PRINT));
    echo "Quiz added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Quiz</title>
</head>
<body>
    <h2>Add Quiz Question</h2>
    <form method="post">
        <label>Question:</label>
        <input type="text" name="question" required>
        <br>
        <label>Option 1:</label>
        <input type="text" name="option1" required>
        <br>
        <label>Option 2:</label>
        <input type="text" name="option2" required>
        <br>
        <label>Option 3:</label>
        <input type="text" name="option3" required>
        <br>
        <label>Option 4:</label>
        <input type="text" name="option4" required>
        <br>
        <label>Answer (1-4):</label>
        <input type="number" name="answer" min="1" max="4" required>
        <br>
        <input type="submit" value="Add Quiz">
    </form>
</body>
</html>