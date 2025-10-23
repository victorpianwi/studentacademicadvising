<?php

session_start();

require_once "config.php";

if(empty($_POST["user_id"])){
    $conn->close();
    die("Course Name is required!");
} else {
    $user_id = trim(htmlspecialchars($_POST["user_id"]));
    $user_id = $conn->real_escape_string($user_id);
}

require_once "get-user.php";

$user = $user->fetch_assoc();

$dep_id = $user["dep_id"];
$level = $user["level"];
$semester = $user["semester"];

$result = [];

$sql = "SELECT * FROM courses WHERE dep_id = ? AND `level` = ?  AND `semester` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $dep_id, $level, $semester);
$stmt->execute();
$new_courses = $stmt->get_result();

if($new_courses->num_rows){
    $new_courses->fetch_assoc();

    foreach($new_courses as $course){
        $course_id = $course["course_id"];
        $dep_id = $course["dep_id"];
        $level = $course["level"];
        $semester = $course["semester"];

        $sql = "INSERT INTO `registered_courses`(`user_id`, `course_id`, `dep_id`, `level`, `semester`) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $user_id, $course_id, $dep_id, $level, $semester);

        if($stmt->execute()){
           $result[] = "success";
        } else {
            $result[] = "error";
        }

    }

    if(in_array("error", $result) === false){
        $conn->close();
        echo "success";
    } else {
        die("An unknown error occurred! Please try again");
    }

} else {
    die("No new courses available for registration");
}

?>