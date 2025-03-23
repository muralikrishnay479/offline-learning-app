<!-- ### add_course.php (Add Course)
```php -->
<?php
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
    echo "Course added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
</head>
<body>
    <h2>Add Course</h2>
    <form method="post">
        <label>Course Code:</label>
        <input type="text" name="course_code" required>
        <br>
        <label>Course Name:</label>
        <input type="text" name="course_name" required>
        <br>
        <label>Course Unit:</label>
        <input type="text" name="course_unit" required>
        <br>
        <label>PDF URL (optional):</label>
        <input type="text" name="pdf_url">
        <br>
        <input type="submit" value="Add Course">
    </form>
</body>
</html>
<!-- ```

### view_course.php (View Courses)
```php -->
