<?php

require_once "config.php";

if(empty($_POST["course_id"])){
    $conn->close();
    die("Course Name is required!");
} else {
    $course_id = trim(htmlspecialchars($_POST["course_id"]));
    $course_id = $conn->real_escape_string($course_id);
}

$sql = "SELECT * FROM `courses` WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $course_id);
$stmt->execute();
$course = $stmt->get_result();
$course = $course->fetch_assoc();

$coursename = $course["course"];
$credit = $course["credit"];
$dep_id = $course["dep_id"];
$level = $course["level"];
$semester = $course["semester"];

$sql = "DELETE FROM `courses` WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $course_id);

if($stmt->execute()){

    $sql = "INSERT INTO `deleted_courses`(`course`, `credit`, `dep_id`, `level`, `semester`) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $coursename, $credit, $dep_id, $level, $semester);
    $stmt->execute();

    $conn->close();
    echo "success";
} else {
    die("An unknown error occurred! Please try again");
}

?>