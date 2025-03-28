<?php
header("Access-Control-Allow-Origin: *");

$courses = json_decode(file_get_contents(__DIR__ . '/admin/courses.json'), true) ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('base.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Course List</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php if (empty($courses)) { ?>
                    <div class="alert alert-warning text-center">No courses available at the moment.</div>
                <?php } else { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Available Courses
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Course Name</th>
                                            <th>Course Code</th>
                                            <th>Unit</th>
                                            <th>PDF Material</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($courses as $course) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                                                <td><?php echo htmlspecialchars($course['course_code']); ?></td>
                                                <td><?php echo htmlspecialchars($course['course_unit']); ?></td>
                                                <td>
                                                    <?php if (!empty($course['pdf_url'])) : ?>
                                                        <a href="<?php echo htmlspecialchars($course['pdf_url']); ?>" target="_blank" class="btn btn-primary">
                                                            View PDF
                                                        </a>
                                                    <?php else : ?>
                                                        <span class="text-muted">No PDF available</span>
                                                    <?php endif; ?>
                                                </td>
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
<?php include('includes/footer.php');?>
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE LOADING TIME -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
