<?php
$videos = file_exists("video_data.txt") ? file("video_data.txt") : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View MP4 Videos</title>
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
                <h1 class="page-head-line">Uploaded MP4 Videos</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <a href="upload_mp4.php" class="btn btn-primary">Upload New Video</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <?php if (empty($videos)) { ?>
                    <div class="alert alert-warning text-center">No videos uploaded yet.</div>
                <?php } else { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Uploaded Videos
                        </div>
                        <div class="panel-body">
                            <?php foreach ($videos as $video) {
                                list($title, $description, $filePath) = explode("||", trim($video));
                                ?>
                                <div class="well">
                                    <h3><?php echo htmlspecialchars($title); ?></h3>
                                    <p><?php echo htmlspecialchars($description); ?></p>
                                    <video width="100%" height="400" controls>
                                        <source src="<?php echo htmlspecialchars($filePath); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            <?php } ?>
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
