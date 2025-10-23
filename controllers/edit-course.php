<?php

require_once "config.php";

if(empty($_POST["course_id"])){
    $conn->close();
    die("Course is required!");
} else {
    $course_id = trim(htmlspecialchars($_POST["course_id"]));
    $course_id = $conn->real_escape_string($course_id);
}

if(empty($_POST["course"])){
    $conn->close();
    die("Course is required!");
} else {
    $course = trim(htmlspecialchars($_POST["course"]));
    $course = $conn->real_escape_string($course);
}

if(empty($_POST["credit"])){
    $conn->close();
    die("Course Credit Unit is required!");
} else {
    $credit = trim(htmlspecialchars($_POST["credit"]));
    $credit = $conn->real_escape_string($credit);
}

if(empty($_POST["dep_id"])){
    $conn->close();
    die("Department Name is required!");
} else {
    $dep_id = trim(htmlspecialchars($_POST["dep_id"]));
    $dep_id = $conn->real_escape_string($dep_id);
}

if(empty($_POST["level"])){
    $conn->close();
    die("Level is required!");
} else {
    $level = trim(htmlspecialchars($_POST["level"]));
    $level = $conn->real_escape_string($level);
}

if(empty($_POST["semester"])){
    $conn->close();
    die("Semester is required!");
} else {
    $semester = trim(htmlspecialchars($_POST["semester"]));
    $semester = $conn->real_escape_string($semester);
}

$sql = "UPDATE courses SET course = ?, credit = ?, dep_id = ?, `level` = ?, `semester` = ? WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $course, $credit, $dep_id, $level, $semester, $course_id);
$stmt->execute();

if($stmt->execute()){

    echo "success";

} else {
    die("An Unknown error occurred! Please try again");
}