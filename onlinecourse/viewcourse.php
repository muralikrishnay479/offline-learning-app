<?php
header("Access-Control-Allow-Origin: *");

$courses = json_decode(file_get_contents(__DIR__ . '\admin\courses.json'), true) ?? [];
// print_r($courses);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Courses</title>
</head>
<body>
    <h2>Course List</h2>
    <ul>
        <?php foreach ($courses as $course) : ?>
            <li>
                <strong>Course Name:</strong> <?php echo $course['course_name']; ?> (<?php echo $course['course_code']; ?>)
                <br>
                <strong>Unit:</strong> <?php echo $course['course_unit']; ?>
                <br>
                <?php if (!empty($course['pdf_url'])) : ?>
                    <a href="<?php echo $course['pdf_url']; ?>" target="_blank">View PDF</a>
                <?php else : ?>
                    <em>No PDF available</em>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
