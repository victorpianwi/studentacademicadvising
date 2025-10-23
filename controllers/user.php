<?php

require_once "config.php";

require_once "get-user.php";

$user = $user->fetch_assoc();

$status = 0;
$user_id = $user["user_id"];
$dep_id = $user["dep_id"];
$level = $user["level"];
$semester = $user["semester"];

$sql = "SELECT COUNT(*) AS active_courses FROM registered_courses WHERE `status` = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $status, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$active_count = $result->fetch_assoc()["active_courses"];

$sql = "SELECT COUNT(*) AS total_courses FROM registered_courses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total_courses = $result->fetch_assoc()["total_courses"];

$sql = "SELECT * FROM courses WHERE dep_id = ? AND `level` = ? AND semester = ? ORDER BY course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $dep_id, $level, $semester);
$stmt->execute();
$new_courses = $stmt->get_result();

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $status, $user_id);
$stmt->execute();
$active_courses = $stmt->get_result();

$status = 1;
$level = 100;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $status, $user_id, $level);
$stmt->execute();
$first_level = $stmt->get_result();

$semester = 1;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? AND r.semester = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $status, $user_id, $level, $semester);
$stmt->execute();
$first_level_first_semester = $stmt->get_result();

$semester = 2;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? AND r.semester = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $status, $user_id, $level, $semester);
$stmt->execute();
$first_level_second_semester = $stmt->get_result();

$level = 200;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $status, $user_id, $level);
$stmt->execute();
$second_level = $stmt->get_result();

$level = 300;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $status, $user_id, $level);
$stmt->execute();
$third_level = $stmt->get_result();

$level = 400;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $status, $user_id, $level);
$stmt->execute();
$fourth_level = $stmt->get_result();

$level = 500;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $status, $user_id, $level);
$stmt->execute();
$fifth_level = $stmt->get_result();

?>