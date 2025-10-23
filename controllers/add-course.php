<?php

require_once "config.php";

if(empty($_POST["course"])){
    $conn->close();
    die("Course Name is required!");
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
    die("Department is required!");
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

$date_in = date('Y-m-d H:i:s');

$sql = "INSERT INTO `courses`(`course`, `credit`, `dep_id`, `level`, `semester`) VALUES (?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $course, $credit, $dep_id, $level, $semester);

if($stmt->execute()){
    $conn->close();
    echo "success";
} else {
    die("An unknown error occurred! Please try again");
}

?>