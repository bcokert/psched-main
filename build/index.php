<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Psched Homepage</title>
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>
<body>
<div class="header">
</div>
<div class="content">
    <div class="scheduler">
        <h3 class="compose-header">Create a Scheduled Message</h3>
        <form id="schedule-message-form" method="post" action="scheduleMessage.php">
            <textarea class="message-compose" placeholder="Enter Message to be scheduled here." name="message"></textarea>
            <input type="text" name="username" placeholder="Enter Your Name Here">
            <h3 class="compose-header">Select a Time to Post Your Message</h3>
            <input type="datetime-local" name="time" value="<?php echo date('Y-m-d\TH:i:00'); ?>">
            <input class="submit-button" type="submit" name="scheduleMessage" value="Schedule">
        </form>
    </div>
    <div class="feed">
<?php
require 'components/feedGrabber.php';
feedGrabber::refreshFeed();
?>
    </div>
</div>
<div class="footer">
</div>
</body>
</html>
