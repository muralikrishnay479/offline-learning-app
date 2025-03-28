<?php
session_start();
header("Access-Control-Allow-Origin: *");

$quizData = json_decode(file_get_contents('C:\xampp\htdocs\onlinecourse\admin\quiz_data.json'), true) ?? [];
$scoresFile = 'C:\xampp\htdocs\onlinecourse\admin\scores.json';
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

    header("Location: useranalysis1.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attempt Quiz</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('base.php'); ?>


<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Attempt Quiz</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Quiz Questions</div>
                    <div class="panel-body">
                        <form method="post">
                            <?php foreach ($quizData as $index => $quiz) : ?>
                                <div class="form-group">
                                    <label><strong><?php echo htmlspecialchars($quiz['question']); ?></strong></label>
                                    <?php foreach ($quiz['options'] as $key => $option) : ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answer[<?php echo $index; ?>]" value="<?php echo $key + 1; ?>" required>
                                                <?php echo htmlspecialchars($option); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary">Submit Quiz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>
<!-- JavaScript at the bottom to reduce loading time -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
