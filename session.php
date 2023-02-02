<?php
session_start();
require_once("config.php");

$user =  $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_ASSOC);

$username = $row['username'];
$name = $row['name'];
$email = $row['email'];
$created_at = $row['created_at'];

if (!isset($user)) {
    header("Location: index.php");
}
