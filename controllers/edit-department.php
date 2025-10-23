<?php

require_once "config.php";

if(empty($_POST["dep_id"])){
    $conn->close();
    die("Department is required!");
} else {
    $dep_id = trim(htmlspecialchars($_POST["dep_id"]));
    $dep_id = $conn->real_escape_string($dep_id);
}

if(empty($_POST["dep_name"])){
    $conn->close();
    die("Department Name is required!");
} else {
    $dep_name = trim(htmlspecialchars($_POST["dep_name"]));
    $dep_name = $conn->real_escape_string($dep_name);
}

if(empty($_POST["fac_name"])){
    $conn->close();
    die("Faculty Name is required!");
} else {
    $fac_name = trim(htmlspecialchars($_POST["fac_name"]));
    $fac_name = $conn->real_escape_string($fac_name);
}

$sql = "UPDATE departments SET dep_name = ?, fac_name = ? WHERE dep_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $dep_name, $fac_name, $dep_id);
$stmt->execute();

if($stmt->execute()){
    // $departments = $stmt->get_result();

    echo "success";

} else {
    die("An Unknown error occurred! Please try again");
}