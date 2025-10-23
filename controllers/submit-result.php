<?php

require_once "config.php";

$response = "";
$gpa_sum = 0;
$credit_sum = 0;
$updated = false;

foreach($_POST["course"] as $course){

    $course_id = trim(htmlspecialchars($course["course_id"]));
    $course_id = $conn->real_escape_string($course_id);

    $result = trim(htmlspecialchars($course["result"]));
    $result = $conn->real_escape_string($result);

    $sql = "SELECT r.*, c.course FROM `registered_courses` r JOIN courses c ON c.course_id = r.course_id WHERE r.course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course_id);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();

    if(empty($result)){
        die(json_encode(["status" => "error","message" => $course["course"]." Result is empty"]));
    }
}


foreach($_POST["course"] as $course){

    $course_id = trim(htmlspecialchars($course["course_id"]));
    $course_id = $conn->real_escape_string($course_id);

    $result = trim(htmlspecialchars($course["result"]));
    $result = $conn->real_escape_string($result);

    $status = 1;

    $sql = "UPDATE `registered_courses` SET `status`= ?, `result`= ? WHERE `course_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $status, $result, $course_id);
    $stmt->execute();

    $sql = "SELECT r.*, c.course, c.credit FROM `registered_courses` r JOIN courses c ON c.course_id = r.course_id WHERE r.course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course_id);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();

    $credit_sum += floatval($course["credit"]);

    if($result == "D" || $result == "E"){
        $response.= "You have a poor performance in ". $course["course"].". ";
    } else if($result == "F"){
        $response.= "You failed ". $course["course"];
    }

    if($result == "A"){
        $product = floatval($course["credit"]) * 5;
        $gpa_sum += $product;
    } else if($result == "B"){
        $product = floatval($course["credit"]) * 4;
        $gpa_sum += $product;
    } else if($result == "C"){
        $product = floatval($course["credit"]) * 3;
        $gpa_sum += $product;
    } else if($result == "D"){
        $product = floatval($course["credit"]) * 2;
        $gpa_sum += $product;
    } else if($result == "E"){
        $product = floatval($course["credit"]) * 1;
        $gpa_sum += $product;
    } else if($result == "F"){
        $product = floatval($course["credit"]) * 0;
        $gpa_sum += $product;
    }

    $user_id = $course["user_id"];

    $sql = "SELECT * FROM users WHERE user_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if($updated == false){
        if($user["semester"] == 1){
            $semester = 2;

            $sql = "UPDATE users SET semester = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $semester, $user_id);
            $stmt->execute();
        } else {
            if($user["level"] != 500){

                $semester = 1;
                $level = floatval($user["level"]) + 100;

                $sql = "UPDATE users SET semester = ?, `level` = ? WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $semester, $level, $user_id);
                $stmt->execute();
            }
        }

        $updated = true;
    }

}

if(preg_match('/poor performance|failed/i', $response)){

    $needed = number_format(5.00 - (floatval($gpa_sum) / floatval($credit_sum)), 2);
    
    echo json_encode(["status" => "success","message" => "Result Successfully Submitted. ". $response. ". You need to have a GPA of ". $needed ." to improve your performance. Try Better."]);
} else {
    echo json_encode(["status" => "success","message" => "Result Successfully Submitted. Good Job. Keep it up and Graduate with a Good Result"]);
}