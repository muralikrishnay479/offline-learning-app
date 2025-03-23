view_pdf.php
<?php
$files = file_exists("pdf_data.txt") ? file("pdf_data.txt") : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDFs</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h2 { text-align: center; }
        .pdf-list { margin-top: 20px; }
        .pdf-item { padding: 10px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>

<div class="container">
    <h2>Uploaded PDFs</h2>
    
    <p style="text-align: center;"><a href="upload_pdf.php">Upload New PDF</a></p>

    <div class="pdf-list">
        <?php if (empty($files)) { ?>
            <p>No PDFs uploaded yet.</p>
        <?php } else {
            foreach ($files as $file) {
                list($title, $description, $filePath) = explode("||", trim($file));
                echo "<div class='pdf-item'>
                        <strong>$title</strong><br>
                        <p>$description</p>
                        <a href='$filePath' target='_blank'>View PDF</a>
                      </div>";
            }
        } ?>
    </div>
</div>

</body>
</html>