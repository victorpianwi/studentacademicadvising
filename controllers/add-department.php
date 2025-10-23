<?php

require_once "config.php";

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

$date_in = date('Y-m-d H:i:s');

$sql = "INSERT INTO `departments`(`dep_name`, `fac_name`, `date_in`) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $dep_name, $fac_name, $date_in);

if($stmt->execute()){
    $conn->close();
    echo "success";
} else {
    die("An unknown error occurred! Please try again");
}

?>