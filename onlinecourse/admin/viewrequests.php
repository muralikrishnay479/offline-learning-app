<?php
session_start();
// Uncomment the following lines if admin authentication is required
// if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//     header("Location: login.php");
//     exit();
// }

$requestsFile = 'requests.json';
$requestsData = json_decode(file_get_contents($requestsFile), true) ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
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
                <h1 class="page-head-line">Submitted Requests</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php if (empty($requestsData)) { ?>
                    <div class="alert alert-warning text-center">No requests submitted yet.</div>
                <?php } else { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Requests List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Request Type</th>
                                            <th>Details</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($requestsData as $request) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($request['username']); ?></td>
                                                <td><?php echo htmlspecialchars($request['type']); ?></td>
                                                <td><?php echo htmlspecialchars($request['details']); ?></td>
                                                <td><?php echo htmlspecialchars($request['timestamp']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');?>
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE LOADING TIME -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
