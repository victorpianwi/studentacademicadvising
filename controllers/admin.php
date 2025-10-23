<?php

require_once "config.php";

$sql = "SELECT * FROM departments ORDER BY dep_name ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$departments = $stmt->get_result();

$sql = "SELECT c.*, d.dep_name FROM courses c JOIN departments d ON c.dep_id = d.dep_id ORDER BY c.course ASC, d.dep_name ASC, c.level ASC;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$courses = $stmt->get_result();

$sql = "SELECT u.*, d.dep_name FROM users u JOIN departments d ON u.dep_id = d.dep_id ORDER BY u.firstname ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->get_result();

$sql = "SELECT COUNT(*) AS total_departments FROM departments";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$dep_count = $result->fetch_assoc()["total_departments"];

$sql = "SELECT COUNT(*) AS total_courses FROM courses";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$course_count = $result->fetch_assoc()["total_courses"];

$sql = "SELECT COUNT(*) AS total_users FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$users_count = $result->fetch_assoc()["total_users"];

?>