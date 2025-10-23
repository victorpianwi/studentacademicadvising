<?php

session_start();

if(isset($_SESSION["online"])){
    header("Location: dashboard");
    exit;
}

?>