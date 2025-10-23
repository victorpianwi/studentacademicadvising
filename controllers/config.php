<?php

if($_SERVER["HTTP_HOST"] == "localhost"){

    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "studentacademicadvising";

} else {

    $host = "localhost";
    $username = "u355950_worldchainltduser";
    $password = "Fl8@GTQWYbbb";
    $db = "u355950_worldchainltd";

}

$conn = new mysqli($host, $username, $password, $db);

?>