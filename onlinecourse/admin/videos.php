upload_mp4.php
<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload MP4</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h2 { text-align: center; }
        .msg { color: red; text-align: center; margin-bottom: 10px; }
        label { font-weight: bold; }
        input, textarea, button { width: 100%; margin: 10px 0; padding: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload MP4 Video</h2>
    <?php if ($msg) echo "<p class='msg'>$msg</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" rows="4"></textarea>

        <label>Choose MP4 File:</label>
        <input type="file" name="video_file" accept="video/mp4" required>

        <button type="submit">Upload Video</button>
    </form>

    <p style="text-align: center;"><a href="view_mp4.php">View Uploaded Videos</a></p>
</div>

</body>
</html>