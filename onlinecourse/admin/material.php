Upload pdf : 
<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: "textarea#description",
            plugins: "autolink lists link image charmap print preview anchor",
            toolbar: "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent"
        });
    </script>
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
    <h2>Upload PDF</h2>
    <?php if ($msg) echo "<p class='msg'>$msg</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <label>Choose PDF File:</label>
        <input type="file" name="pdf_file" accept="application/pdf" required>

        <button type="submit">Upload PDF</button>
    </form>

    <p style="text-align: center;"><a href="view_pdf.php">View Uploaded PDFs</a></p>
</div>

</body>
</html>