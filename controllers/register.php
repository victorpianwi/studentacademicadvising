<?php

error_reporting(0);

session_start();

require_once "config.php";

if(empty($_POST["firstname"])){
    $conn->close();
    die("Firstname is required!");
} else {
    $firstname = trim(htmlspecialchars($_POST["firstname"]));
    $firstname = $conn->real_escape_string($firstname);
}

if(empty($_POST["lastname"])){
    $conn->close();
    die("Lastname is required!");
} else {
    $lastname = trim(htmlspecialchars($_POST["lastname"]));
    $lastname = $conn->real_escape_string($lastname);
}

if(empty($_POST["email"])){
    $conn->close();
    die("Email is required!");
} else {
    $email = trim(htmlspecialchars($_POST["email"]));
    $email = $conn->real_escape_string($email);
}

if(empty($_POST["gender"])){
    $conn->close();
    die("Your Gender is required!");
} else {
    $gender = trim(htmlspecialchars($_POST["gender"]));
    $gender = $conn->real_escape_string($gender);
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
    die("Your Level is required!");
} else {
    $level = trim(htmlspecialchars($_POST["level"]));
    $level = $conn->real_escape_string($level);
}

if(empty($_POST["semester"])){
    $conn->close();
    die("Your Semester is required!");
} else {
    $semester = trim(htmlspecialchars($_POST["semester"]));
    $semester = $conn->real_escape_string($semester);
}

if(empty($_POST["mat_no"])){
    $conn->close();
    die("Your Matriculation Number is required!");
} else {
    $mat_no = trim(htmlspecialchars($_POST["mat_no"]));
    $mat_no = $conn->real_escape_string($mat_no);
}

$pattern = '/^U\d{4}\/\d{7}$/';

if(!preg_match($pattern, $mat_no)){
    die("Invalid Matriculation Number!");
}

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

$sql = "SELECT * FROM users WHERE email = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result();

if($user->num_rows){

    $conn->close();    
    die("Email already exits!");

}

$sql = "SELECT * FROM users WHERE username = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result();

if($user->num_rows){

    $conn->close();    
    die("Username already exits!");

}

$date_in = date('Y-m-d H:i:s');

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `dep_id`, `level`, `semester`, `mat_no`, `username`, `gender`, `password`, `date_in`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $firstname, $lastname, $email, $dep_id, $level, $semester, $mat_no, $username, $gender, $password, $date_in);

if($stmt->execute()){

    $_SESSION["online"] = "active";
    $_SESSION["username"] = $username;
    $_SESSION["admin"] = false;
    echo "success";

}

?>