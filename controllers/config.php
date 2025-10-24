<?php

if($_SERVER["HTTP_HOST"] == "localhost"){

    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "studentacademicadvising";

} else {

    $host = "centerbeam.proxy.rlwy.net";
    $username = "root";
    $password = "OBuRwWSGGKKUFGvbcgANJxBUaaJzIoxL";
    $db = "railway";
    $port = 58857;

}

$conn = new mysqli($host, $username, $password, $db, $port);

?>