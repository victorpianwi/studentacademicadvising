<?php

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

$sql = "SELECT * FROM users WHERE username = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result();

?>