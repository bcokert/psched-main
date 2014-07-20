<?php
// POST message=... username=... time=...

$json = array();
foreach ($_POST as $key=>$value) {
    $json["received"][$key] = urldecode($value);
}

if ($json["received"]["username"] and strlen($json["received"]["username"]) >= 1
    and $json["received"]["message"] and strlen($json["received"]["message"]) > 1
    and $json["received"]["time"] and strlen($json["received"]["time"]) > 1) {

    /* Prepare post message */
    $forward_url = "192.168.0.110/scheduleMessage.php";
    $post_data = array(
        "username" => urlencode($json["received"]["username"]),
        "message" => urlencode($json["received"]["message"]),
        "time" => urlencode(str_replace("T", " ", $json["received"]["time"]))
    );

    /* Prepare cURL, which will post our message */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $forward_url);
    curl_setopt($ch, CURLOPT_POST, count($post_data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    /* Execute Post */
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result) {
        $json["result"] = "Success";
        $json["externalResult"] = json_decode($result);
    } else {
        $json["result"] = "Failure";
        $json["failure"] = "No response from Dispatcher";
    }
} else {
    $json["result"] = "Failure";
    $json["failure"] = "Invalid Post. Expected three non-zero strings (username, message, time).";
}

echo json_encode($json);
?>

