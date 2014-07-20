<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Message Result</title>
</head>
<body>

<?php
// POST message=... username=...
if ($_POST["username"] and strlen($_POST["username"]) >= 1 and $_POST["message"] and strlen($_POST["message"]) > 1) {
    echo "<p>Posting message with username=" . $_POST["username"] . " and message=" . $_POST["message"] . "</p>\n";
    $mysqli = new mysqli("localhost", "psched-poster", "psched4brandon", "psched");
    if (mysqli_connect_errno()) {
        echo "<p>Failed to connect to database: " . mysqli_connect_error() . "</p>\n";
    } else {
        if (!($update = $mysqli->prepare("INSERT INTO feed (poster_name, message) values (?, ?)"))) {
            echo "<p>Failed to create SQL statement</p>\n";
        } else {
            $update->bind_param("ss", $_POST["username"], $_POST["message"]);
            if (!$update->execute()) {
                echo "<p>Failed to post message. Error: " . mysqli_error() . "</p>\n";
            } else {
                echo "<p>Success!</p>\n";
            }
        }
    }
} else {
    echo "<p>Invalid Post. Expected two non-zero strings (username, message). Received: </p>\n";
    echo "<ul>";
    foreach ($_POST as $key=>$value) {
        echo "<li>" . $key . "=" . $value . "</li>\n";
    }
    echo "</ul>";
}
?>

</body>
</html>
