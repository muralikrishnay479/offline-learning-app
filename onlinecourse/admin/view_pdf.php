<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View PDFs</title>
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
                <h1 class="page-head-line">Uploaded PDFs</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        View Your Uploaded PDFs
                    </div>
                    <div class="panel-body">
                        <?php
                        $file = "pdf_data.txt";
                        if (file_exists($file)) {
                            $entries = file($file, FILE_IGNORE_NEW_LINES);
                            foreach ($entries as $entry) {
                                list($title, $description, $path) = explode("||", $entry);
                                echo "<div class='panel panel-info'>";
                                echo "<div class='panel-heading'>" . htmlspecialchars($title) . "</div>";
                                echo "<div class='panel-body'>";
                                echo "<p>" . htmlspecialchars_decode($description) . "</p>";
                                echo "<a href='$path' target='_blank' class='btn btn-primary'>View PDF</a>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div class='alert alert-warning text-center'>No PDFs uploaded yet.</div>";
                        }
                        ?>
                    </div>
                </div>
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
