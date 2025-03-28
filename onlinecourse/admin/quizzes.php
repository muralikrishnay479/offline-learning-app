<?php
session_start();
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quizData = json_decode(file_get_contents('quiz_data.json'), true) ?? [];

    $newQuiz = [
        'question' => $_POST['question'],
        'options' => [$_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option4']],
        'answer' => $_POST['answer']
    ];

    $quizData[] = $newQuiz;
    file_put_contents('quiz_data.json', json_encode($quizData, JSON_PRETTY_PRINT));

    $_SESSION['msg'] = "Question added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Quiz</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('../base.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Add Quiz Question</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add New Quiz
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($_SESSION['msg'])): ?>
                            <div class="alert alert-success">
                                <?php 
                                    echo $_SESSION['msg']; 
                                    unset($_SESSION['msg']); // Clear message after displaying
                                ?>
                            </div>
                        <?php endif; ?>

                        <form method="post">
                            <div class="form-group">
                                <label>Question:</label>
                                <input type="text" class="form-control" name="question" placeholder="Enter the quiz question" required>
                            </div>
                            <div class="form-group">
                                <label>Option 1:</label>
                                <input type="text" class="form-control" name="option1" placeholder="Enter option 1" required>
                            </div>
                            <div class="form-group">
                                <label>Option 2:</label>
                                <input type="text" class="form-control" name="option2" placeholder="Enter option 2" required>
                            </div>
                            <div class="form-group">
                                <label>Option 3:</label>
                                <input type="text" class="form-control" name="option3" placeholder="Enter option 3" required>
                            </div>
                            <div class="form-group">
                                <label>Option 4:</label>
                                <input type="text" class="form-control" name="option4" placeholder="Enter option 4" required>
                            </div>
                            <div class="form-group">
                                <label>Answer (1-4):</label>
                                <input type="number" class="form-control" name="answer" min="1" max="4" placeholder="Enter the correct answer (1-4)" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Quiz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');?>
<!-- JavaScript at the bottom to reduce loading time -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
