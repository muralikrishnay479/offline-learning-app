<?php
session_start();

$scoresFile = 'scores.json';
$quizData = json_decode(file_get_contents('quiz_data.json'), true) ?? [];
$scoresData = json_decode(file_get_contents($scoresFile), true) ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Score Analysis</title>
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
                <h1 class="page-head-line">Score Analysis</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Scores
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Quiz Attempted</th>
                                    <th>Marks Scored</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($scoresData as $score) : ?>
                                    <tr>
                                        <td><?php echo htmlentities($score['username']); ?></td>
                                        <td><?php echo htmlentities($score['attempted']); ?></td>
                                        <td><?php echo htmlentities($score['score']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');?>
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
