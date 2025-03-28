<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courses = json_decode(file_get_contents('courses.json'), true) ?? [];

    $newCourse = [
        'course_code' => $_POST['course_code'],
        'course_name' => $_POST['course_name'],
        'course_unit' => $_POST['course_unit'],
        'pdf_url' => $_POST['pdf_url'] ?? ''
    ];

    $courses[] = $newCourse;
    file_put_contents('courses.json', json_encode($courses, JSON_PRETTY_PRINT));

    $_SESSION['msg'] = "Course added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
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
                <h1 class="page-head-line">Add New Course</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Course
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($_SESSION['msg'])): ?>
                            <div class="alert alert-success">
                                <?php 
                                    echo $_SESSION['msg']; 
                                    unset($_SESSION['msg']); // Clear the message after displaying
                                ?>
                            </div>
                        <?php endif; ?>

                        <form method="post">
                            <div class="form-group">
                                <label>Course Code</label>
                                <input type="text" class="form-control" name="course_code" placeholder="Enter Course Code" required>
                            </div>
                            <div class="form-group">
                                <label>Course Name</label>
                                <input type="text" class="form-control" name="course_name" placeholder="Enter Course Name" required>
                            </div>
                            <div class="form-group">
                                <label>Course Unit</label>
                                <input type="text" class="form-control" name="course_unit" placeholder="Enter Course Unit" required>
                            </div>
                            <div class="form-group">
                                <label>PDF URL (optional)</label>
                                <input type="text" class="form-control" name="pdf_url" placeholder="Enter PDF URL">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');?>
<!-- JavaScript at the bottom to reduce loading time -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
