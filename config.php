<?php
// config.php
// Update these with your real credentials
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'feedback_db';
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die("DB connection failed: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
?>
