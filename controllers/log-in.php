<?php

error_reporting(0);

session_start();

require_once "config.php";

if(empty($_POST["username"])){
    $conn->close();
    die("Username is required!");
} else {
    $username = trim(htmlspecialchars($_POST["username"]));
    $username = $conn->real_escape_string($username);
}

if(empty($_POST["password"])){
    $conn->close();
    die("Password is required!");
} else {
    $password = htmlspecialchars($_POST["password"]);
    $password = $conn->real_escape_string($password);
}

$sql = "SELECT * FROM users WHERE username = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result();

if($user->num_rows){
    $user = $user->fetch_assoc();
    $password_hash = $user["password"];
    if(password_verify($password, $password_hash)){

        $_SESSION["online"] = "active";
        $_SESSION["username"] = $username;

        if($user["admin"]){
            $_SESSION["admin"] = true;
            $conn->close();
            echo "admin";
        } else {
            $_SESSION["admin"] = false;
            $conn->close();
            echo "success";
        }
        
    } else {
        $conn->close();
        die("Incorrect password!");
    }
} else {
    $conn->close();
    die("Invalid username!");
}



?>