<?php
session_start();

$uploadDir = 'uploads/';

// Ensure the uploads directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$msg = "";

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["video_file"])) {
    $title = htmlspecialchars($_POST['title']);
    $description = $_POST['description'];
    $file = $_FILES["video_file"];

    if (empty($title) || empty($description)) {
        $msg = "Title and Description are required!";
    } elseif ($file["type"] !== "video/mp4") {
        $msg = "Only MP4 video files are allowed!";
    } else {
        $targetFile = $uploadDir . time() . "_" . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Save video details to a local text file
            $entry = "$title||$description||$targetFile\n";
            file_put_contents("video_data.txt", $entry, FILE_APPEND);
            $msg = "Video uploaded successfully!";
        } else {
            $msg = "File upload failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload MP4 Video</title>
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
                <h1 class="page-head-line">Upload MP4 Video</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload Your Video
                    </div>
                    <div class="panel-body">
                        <?php if ($msg): ?>
                            <div class="alert alert-info text-center">
                                <?php echo htmlentities($msg); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Title:</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" name="description" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Choose MP4 File:</label>
                                <input type="file" class="form-control" name="video_file" accept="video/mp4" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Video</button>
                        </form>

                        <hr />
                        <p class="text-center">
                            <a href="view_mp4.php" class="btn btn-success">View Uploaded Videos</a>
                        </p>
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
