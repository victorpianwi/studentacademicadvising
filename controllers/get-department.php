<?php

require_once "config.php";

if(empty($_POST["dep_id"])){
    $conn->close();
    die("Department is required!");
} else {
    $dep_id = trim(htmlspecialchars($_POST["dep_id"]));
    $dep_id = $conn->real_escape_string($dep_id);
}

$sql = "SELECT * FROM departments WHERE dep_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $dep_id);

if($stmt->execute()){
    $departments = $stmt->get_result();

    $departments = $departments->fetch_assoc();

    $response = [
        "dep_name" => $departments["dep_name"],
        "fac_name" => $departments["fac_name"],
        "message" => "success"
    ];

    echo json_encode($response);

} else {
    die(json_encode(["message" => "An Unknown error occurred! Please try again"]));
}