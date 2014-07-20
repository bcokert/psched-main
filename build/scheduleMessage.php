<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Message Result</title>
</head>
<body>

<?php
// POST message=... username=... time=...
if ($_POST["username"] and strlen($_POST["username"]) >= 1
    and $_POST["message"] and strlen($_POST["message"]) > 1
    and $_POST["time"] and strlen($_POST["time"]) > 1) {

    $cleanTime = str_replace("T", " ", $_POST["time"]);

    echo "<p>Posting message with username=" . $_POST["username"] . " and message=" . $_POST["message"] . " and time=" . $cleanTime ."</p>\n";

    /* Prepare post message */
    $forward_url = "192.168.0.110/scheduleMessage.php";
    $post_data = array(
        "username" => urlencode($_POST["username"]),
        "message" => urlencode($_POST["message"]),
        "time" => urlencode($cleanTime)
    );
    $post_data_prepared = http_build_query($post_data);

    /* Prepare cURL, which will post our message */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $forward_url);
    curl_setopt($ch, CURLOPT_POST, count($post_data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data_prepared);

    /* Execute Post */
    $result = curl_exec($ch);
    curl_close($ch);
} else {
    echo "<p>Invalid Post. Expected three non-zero strings (username, message, time). Received: </p>\n";
    echo "<ul>";
    foreach ($_POST as $key=>$value) {
        echo "<li>" . $key . "=" . $value . "</li>\n";
    }
    echo "</ul>";
}
?>

</body>
</html>
