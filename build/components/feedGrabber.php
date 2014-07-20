<?php
class feedGrabber {
    private static $mysqli;

    public static function refreshFeed() {
        if (!self::$mysqli) {
            self::$mysqli = new mysqli("localhost", "psched-feed", "psched4brandon", "psched");
        }

        if (self::$mysqli->connect_errno) {
            echo "Failed to collect feed. The internal error is: " . self::$mysqli->connect_errno . " :: " . self::$mysqli->connect_error;
        } else {
            $result = self::$mysqli->query("SELECT * FROM feed ORDER BY post_id ASC");
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"post\">\n";
                echo "<span class=\"background-text\">Posted By</span>\n";
                echo "<span class=\"user\">&nbsp;" . $row["poster_name"] . "</span>\n";
                echo "<span class=\"background-text\">&nbsp;at " . $row["time_posted"] . "</span>\n";
                echo "<p>" . $row["message"] . "</p>\n";
                echo "</div>\n";
            }
        }
    }
}
?>
