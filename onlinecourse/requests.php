<?php
session_start();
header("Access-Control-Allow-Origin: *");

$requestsFile = 'requests.json';
$requestsData = json_decode(file_get_contents($requestsFile), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newRequest = [
        // 'username' => $_SESSION['user'],  // Uncomment and use session username if available
        'type' => htmlspecialchars($_POST['type']),
        'details' => htmlspecialchars($_POST['details']),
        'timestamp' => date('Y-m-d H:i:s')
    ];

    $requestsData[] = $newRequest;
    file_put_contents($requestsFile, json_encode($requestsData, JSON_PRETTY_PRINT));

    $msg = "Request submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Request</title>
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
                <h1 class="page-head-line">Submit Request</h1>
                <?php if (!empty($msg)): ?>
                    <div class="alert alert-success text-center">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">New Request</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="type">Request Type:</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="PDF">PDF Upload</option>
                                    <option value="MP4">MP4 Upload</option>
                                    <option value="Quiz">New Quiz</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="details">Details:</label>
                                <textarea name="details" id="details" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE LOADING TIME -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
