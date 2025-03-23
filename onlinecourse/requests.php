

<?php
session_start();

//if (!isset($_SESSION['user'])) {
    //header("Location: login.php");
    //exit();//
//}
$requestsFile = 'requests.json';
$requestsData = json_decode(file_get_contents($requestsFile), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newRequest = [
        //'username' => $_SESSION['user'],
        'type' => $_POST['type'],
        'details' => $_POST['details'],
        'timestamp' => date('Y-m-d H:i:s')
    ];

    $requestsData[] = $newRequest;
    file_put_contents($requestsFile, json_encode($requestsData, JSON_PRETTY_PRINT));

    echo "Request submitted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Request</title>
</head>
<body>
    <h2>Submit Request</h2>
    <form method="post">
        <label>Request Type:</label>
        <select name="type" required>
            <option value="PDF">PDF Upload</option>
            <option value="MP4">MP4 Upload</option>
            <option value="Quiz">New Quiz</option>
        </select>
        <br>
        <label>Details:</label>
        <textarea name="details" required></textarea>
        <br>
        <input type="submit" value="Submit Request">
    </form>
</body>
</html>