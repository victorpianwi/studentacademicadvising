<?php

require_once "config.php";

if(empty($_POST["course_id"])){
    $conn->close();
    die("Course is required!");
} else {
    $course_id = trim(htmlspecialchars($_POST["course_id"]));
    $course_id = $conn->real_escape_string($course_id);
}

$sql = "SELECT c.*, d.dep_id, d.dep_name FROM courses c JOIN departments d ON c.dep_id = d.dep_id WHERE c.course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $course_id);

if($stmt->execute()){
    $course = $stmt->get_result();

    $course = $course->fetch_assoc();

    $response = [
        "course" => $course["course"],
        "credit" => $course["credit"],
        "dep_id" => $course["dep_id"],
        "level" => $course["level"],
        "semester" => $course["semester"],
        "message" => "success"
    ];

    echo json_encode($response);

} else {
    die(json_encode(["message" => "An Unknown error occurred! Please try again"]));
}