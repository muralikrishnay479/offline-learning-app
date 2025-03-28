<?php
session_start();

$uploadDir = 'uploads/';

// Ensure the uploads directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$msg = "";

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdf_file"])) {
    $title = htmlspecialchars($_POST['title']);
    $description = $_POST['description'];
    $file = $_FILES["pdf_file"];

    if (empty($title) || empty($description)) {
        $msg = "Title and Description are required!";
    } elseif ($file["type"] !== "application/pdf") {
        $msg = "Only PDF files are allowed!";
    } else {
        $targetFile = $uploadDir . time() . "_" . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Save file details to a local text file
            $entry = "$title||$description||$targetFile\n";
            file_put_contents("pdf_data.txt", $entry, FILE_APPEND);
            $msg = "PDF uploaded successfully!";
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
    <title>Upload PDF</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script>
        tinymce.init({
            selector: "textarea#description",
            plugins: "autolink lists link image charmap print preview anchor",
            toolbar: "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent"
        });
    </script>
</head>
<body>
<?php include('../base.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Upload PDF</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload PDF File
                    </div>
                    <font color="green" align="center"><?php echo htmlentities($msg); ?></font>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Title:</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter PDF Title" required>
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea id="description" class="form-control" name="description" rows="4" placeholder="Enter PDF Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Choose PDF File:</label>
                                <input type="file" class="form-control" name="pdf_file" accept="application/pdf" required>
                            </div>
                            <button type="submit" class="btn btn-default">Upload PDF</button>
                        </form>
                        <p style="text-align: center; margin-top: 10px;">
                            <a href="view_pdf.php">View Uploaded PDFs</a>
                        </p>
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
