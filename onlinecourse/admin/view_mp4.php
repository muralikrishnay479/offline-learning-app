view_mp4.php
<?php
$videos = file_exists("video_data.txt") ? file("video_data.txt") : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View MP4 Videos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h2 { text-align: center; }
        .video-list { margin-top: 20px; }
        .video-item { padding: 10px; border-bottom: 1px solid #ddd; text-align: center; }
    </style>
</head>
<body>

<div class="container">
    <h2>Uploaded MP4 Videos</h2>
    
    <p style="text-align: center;"><a href="upload_mp4.php">Upload New Video</a></p>

    <div class="video-list">
        <?php if (empty($videos)) { ?>
            <p>No videos uploaded yet.</p>
        <?php } else {
            foreach ($videos as $video) {
                list($title, $description, $filePath) = explode("||", trim($video));
                echo "<div class='video-item'>
                        <strong>$title</strong><br>
                        <p>$description</p>
                        <video width='100%' height='300' controls>
                            <source src='$filePath' type='video/mp4'>
                            Your browser does not support the video tag.
                        </video>
                      </div>";
            }
        } ?>
    </div>
</div>

</body>
</html>