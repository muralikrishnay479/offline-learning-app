admin-requests.php

<?php
session_start();
///if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    //header("Location: login.php");
   // exit();
//}

$requestsFile = 'requests.json';
$requestsData = json_decode(file_get_contents($requestsFile), true) ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Requests</title>
</head>
<body>
    <h2>Submitted Requests</h2>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Request Type</th>
            <th>Details</th>
            <th>Timestamp</th>
        </tr>
        <?php foreach ($requestsData as $request) : ?>
            <tr>
                <td><?php echo htmlspecialchars($request['username']); ?></td>
                <td><?php echo htmlspecialchars($request['type']); ?></td>
                <td><?php echo htmlspecialchars($request['details']); ?></td>
                <td><?php echo htmlspecialchars($request['timestamp']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>