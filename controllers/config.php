<?php

if($_SERVER["HTTP_HOST"] == "localhost"){

    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "studentacademicadvising";

} else {

    $host = "mysql.railway.internal";
    $username = "root";
    $password = "OBuRwWSGGKKUFGvbcgANJxBUaaJzIoxL";
    $db = "railway";

}

$conn = new mysqli($host, $username, $password, $db);

?>