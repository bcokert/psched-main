<?php
// POST message=... username=...

$json = array();
foreach ($_POST as $key=>$value) {
    $json["received"][$key] = urldecode($value);
}

if ($json["received"]["username"] and strlen($json["received"]["username"]) >= 1
    and $json["received"]["message"] and strlen($json["received"]["message"]) > 1) {

    $mysqli = new mysqli("localhost", "psched-poster", "psched4brandon", "psched");
    if (mysqli_connect_errno()) {
        $json["failure"] = "Failed to connect to database: " . mysqli_connect_error();
        $json["result"] = "Failure";
    } else {
        if (!($update = $mysqli->prepare("INSERT INTO feed (poster_name, message) values (?, ?)"))) {
            $json["failure"] = "Failed to create SQL statement";
            $json["result"] = "Failure";
        } else {
            $update->bind_param("ss", $json["received"]["username"], $json["received"]["message"]);
            if (!$update->execute()) {
                $json["failure"] = "Failed to post message. Error: " . mysqli_error();
                $json["result"] = "Failure";
            } else {
                $json["result"] = "Success";
            }
        }
    }
} else {
    $json["result"] = "Failure";
    $json["failure"] = "Invalid Post. Expected two non-zero strings (username, message)";
}

echo json_encode($json);
?>

