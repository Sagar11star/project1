<?php
// submit.php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$name = isset($_POST['name']) ? trim($_POST['name']) : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if ($message === '') {
    header('Location: feedback.html?error=empty');
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
if (!$stmt) {
    http_response_code(500);
    exit('Prepare failed: ' . $mysqli->error);
}

$stmt->bind_param('sss', $name, $email, $message);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    header('Location: feedback.html?success=1');
    exit;
} else {
    http_response_code(500);
    exit('Insert failed: ' . $mysqli->error);
}
